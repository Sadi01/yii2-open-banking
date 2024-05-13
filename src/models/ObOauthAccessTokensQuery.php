<?php

namespace sadi01\openbanking\models;

/**
* This is the ActiveQuery class for [[ObOauthAccessTokens]].
*
* @see ObOauthAccessTokens
*/
class ObOauthAccessTokensQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
    return $this->onCondition(['<>', ObOauthAccessTokens::tableName() . '.status', ObOauthAccessTokens::STATUS_DELETED]);
    }

/**
* {@inheritdoc}
* @return ObOauthAccessTokens[]|array
*/
public function all($db = null)
{
return parent::all($db);
}

/**
* {@inheritdoc}
* @return ObOauthAccessTokens|array|null
*/
public function one($db = null)
{
return parent::one($db);
}
}