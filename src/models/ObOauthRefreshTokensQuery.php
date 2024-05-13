<?php

namespace sadi01\openbanking\models;

/**
* This is the ActiveQuery class for [[ObOauthRefreshTokens]].
*
* @see ObOauthRefreshTokens
*/
class ObOauthRefreshTokensQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
    return $this->onCondition(['<>', ObOauthRefreshTokens::tableName() . '.status', ObOauthRefreshTokens::STATUS_DELETED]);
    }

/**
* {@inheritdoc}
* @return ObOauthRefreshTokens[]|array
*/
public function all($db = null)
{
return parent::all($db);
}

/**
* {@inheritdoc}
* @return ObOauthRefreshTokens|array|null
*/
public function one($db = null)
{
return parent::one($db);
}
}