<?php

namespace frontend\controllers;

use backend\models\Category;
use common\helper\Constants;
use common\helper\HelperMethods;
use frontend\models\Item;
use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\ItemSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SearchItem;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'change-language' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;

        $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();
        Yii::$app->language = $language;
        Yii::$app->sourceLanguage = $language;

        if ($language == Constants::ARABIC_LANGUAGE) {
            $this->layout = "main-ar";
        }

        return true;
    }

    public function actionChangeLanguage()
    {
        if (Yii::$app->language == Constants::DEFAULT_LANGUAGE) {
            $lang = Constants::ARABIC_LANGUAGE;
        } else {
            $lang = Constants::DEFAULT_LANGUAGE;
        }
        HelperMethods::setLanguageIntoSession($lang);
    }

    public function actionCategoryItems($id)
    {
        Yii::$app->language = Constants::DEFAULT_LANGUAGE;
        $name = Category::findOne($id)->name;
        $categories = Category::find()->where(['like', 'name', $name])->all();


        $query = Item::find();
        foreach ($categories as $category) {
            $query->orWhere(["category_id" => $category->id]);
        }

        $query->joinWith("shop");
        $items = $query->andWhere(["shop.status" => "active"])->all();

        $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();
        Yii::$app->language = $language;
        if ($language == Constants::ARABIC_LANGUAGE) {
            $this->layout = "home-ar";
        } else {
            $this->layout = "home-en";
        }


        return $this->render('index', [
            'dataProvider' => $items,
        ]);

    }

    public function actionSearchItem()
    {
        $model = new SearchItem();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $searchModel = new ItemSearch();
            $searchModel->name = $model->item_name;
            $searchModel->shopRate = $model->shop_rate;
            $searchModel->lowestPrice = $model->lowest_price;
            $searchModel->nearByShop = $model->near_by_shop;
            if ($model->near_by_shop == 1) {
                $searchModel->longitude = $model->longitude;
                $searchModel->latitude = $model->latitude;
            }

            $items = $searchModel->search(Yii::$app->request->queryParams)->models;


            $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();

            if ($language == Constants::ARABIC_LANGUAGE) {
                $this->layout = "home-ar";
            } else {
                $this->layout = "home-en";
            }
            return $this->render('index', [
                'dataProvider' => $items,
            ]);
        }

        return $this->renderAjax('_serachFrom', [
            'model' => $model,
        ]);
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();

        if ($language == Constants::ARABIC_LANGUAGE) {
            $this->layout = "home-ar";
        } else {
            $this->layout = "home-en";
        }

        $query = Item::find()->joinWith("shop")->where(["shop.status" => "active"]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);


        $items = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'dataProvider' => $items,
            'pages' => $pages,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();

        if ($language == Constants::ARABIC_LANGUAGE) {
            $this->layout = "login-ar";
        } else {
            $this->layout = "login-en";
        }
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->type = "seller";
            if ($model->login())
                return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $language = HelperMethods::getLanguageFromSessionOrSetIfNotExists();

        if ($language == Constants::ARABIC_LANGUAGE) {
            $this->layout = "login-ar";
        } else {
            $this->layout = "login-en";
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
