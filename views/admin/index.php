<?php
/* @var $this \humhub\components\View */
/* @var $model \humhubContrib\auth\moodle\models\ConfigureForm */

use humhub\widgets\form\ActiveForm;
use yii\helpers\Html;

?>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Yii::t('AuthMoodleModule.base', '<strong>Moodle</strong> Sign-In configuration') ?></div>

        <div class="panel-body">
            <p>
                <?php /* TODO: Update documentation link to Moodle OAuth documentation */ ?>
                <?= Html::a(Yii::t('AuthMoodleModule.base', 'Moodle OAuth Documentation'), 'https://docs.moodle.org/en/OAuth_2_services', ['class' => 'btn btn-primary float-end btn-sm', 'target' => '_blank']); ?>
                <?= Yii::t('AuthMoodleModule.base', 'Please follow the Moodle instructions to create the required <strong>OAuth client</strong> credentials.'); ?>
                <br/>
            </p>
            <br/>

            <?php $form = ActiveForm::begin(['id' => 'configure-form', 'enableClientValidation' => false, 'enableClientScript' => false]); ?>

            <?= $form->field($model, 'enabled')->checkbox(); ?>

            <br/>
            <?= $form->field($model, 'clientId'); ?>
            <?= $form->field($model, 'clientSecret'); ?>

            <br/>
            <?= $form->field($model, 'redirectUri')->textInput(['readonly' => true])->hint(Yii::t('AuthMoodleModule.base', 'Copy this URL and add it to your Moodle OAuth configuration as an authorized redirect URI.')); ?>
            <br/>

            <div class="mb-3">
                <?= Html::submitButton(Yii::t('base', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <!-- TODO: Consider adding these helpful sections -->
            <hr/>
            <div class="alert alert-info">
                <strong><?= Yii::t('AuthMoodleModule.base', 'Setup Instructions:') ?></strong>
                <ol>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Go to your Moodle instance: Site administration → Server → OAuth 2 services') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Create a new OAuth 2 service or configure an existing one') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Copy the Client ID and Client Secret from Moodle') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Paste them in the fields above') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Copy the Redirect URI from above') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Add it to your Moodle OAuth configuration') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Enable the module and save') ?></li>
                </ol>
            </div>

            <div class="alert alert-warning">
                <strong><?= Yii::t('AuthMoodleModule.base', 'Testing Required:') ?></strong>
                <ul>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Verify OAuth endpoint URLs in MoodleAuth.php') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Test user login flow') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Test user registration flow') ?></li>
                    <li><?= Yii::t('AuthMoodleModule.base', 'Verify user attribute mappings') ?></li>
                </ul>
            </div>

        </div>
    </div>
</div>
