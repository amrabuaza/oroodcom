<?php

namespace common\helper;


use Yii;

abstract class HelperMethods
{
    public static function getLanguageFromSessionOrSetIfNotExists()
    {
        $session = Yii::$app->session;
        if ($session->get(Constants::USER_LANGUAGE_KEY) == null) {
            $session->set(Constants::USER_LANGUAGE_KEY, Constants::DEFAULT_LANGUAGE);
            return Constants::DEFAULT_LANGUAGE;
        } else {
            return $session->get(Constants::USER_LANGUAGE_KEY);
        }
    }

    public static function setLanguageIntoSession($language)
    {
        $session = Yii::$app->session;
        if ($session->get(Constants::USER_LANGUAGE_KEY) != null) {
            $session->remove(Constants::USER_LANGUAGE_KEY);
        }
        $session->set(Constants::USER_LANGUAGE_KEY, $language);
    }

    public static function setShopIdIntoSession($id)
    {
        $session = Yii::$app->session;
        if ($session->get(Constants::SHOP_ID) != null) {
            $session->remove(Constants::SHOP_ID);
        }
        $session->set(Constants::SHOP_ID, $id);
    }

    public static function getShopIdSession()
    {
        $session = Yii::$app->session;
        return $session->get(Constants::SHOP_ID);
    }

}