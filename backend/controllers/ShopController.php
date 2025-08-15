<?php

namespace backend\controllers;

use backend\models\contact\Contact;
use backend\models\contract\Contract;
use backend\models\deal\Deal;
use backend\models\contact\Form;
use backend\models\contract\Form as Form2;
use backend\models\deal\Form as Form3;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class ShopController extends \yii\web\Controller
{
    public $layout = 'shop';

    public function actionIndex()
    {
        $this->view->params['link'] = '';

        return $this->render('index');
    }

    public function actionContacts()
    {
        $this->view->params['link'] = 'contacts';

        $dataProvider = new ActiveDataProvider([
            'query' => Contact::getAll(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('contacts', ['contactsDataProvider' => $dataProvider]);
    }

    public function actionEditcontact(int $id)
    {
        $this->view->params['link'] = 'contacts';

        $modelForm = new Form();

        if ($id > 0) {
            $contact = Contact::getOne($id);
            if (!$contact) throw new \yii\web\NotFoundHttpException();
            $modelForm->setAttributes($contact);
        }

        // populate model attributes with user inputs
        if ($data = \Yii::$app->request->post()) {
            $modelForm->load($data);

            if ($modelForm->validate()) {
                // all inputs are valid
                if ($id > 0) {
                    Yii::$app->db->createCommand()->update(Contact::$tableName, [
                        'firstname' => $modelForm->firstname,
                        'lastname' => $modelForm->lastname,
                    ], ['id' => $id])->execute();
                } else {
                    Yii::$app->db->createCommand()->insert(Contact::$tableName, [
                        'firstname' => $modelForm->firstname,
                        'lastname' => $modelForm->lastname,
                    ])->execute();
                }

                $this->redirect(Url::to('/shop/contacts'));
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $modelForm->errors;
            }
        }

        return $this->render('contact', ['modelForm' => $modelForm, 'contactId' => $id]);
    }

    public function actionDeletecontact(int $id) {
        $contact = Contact::getOne($id);
        if (!$contact) throw new \yii\web\NotFoundHttpException();

        Yii::$app->db->createCommand()->delete(Contact::$tableName, ['id' => $id])->execute();

        Yii::$app->db->createCommand()->delete(Deal::$tableName, ['contact' => $id])->execute();

        $this->redirect(Url::to('/shop/contacts'));
    }

    public function actionContracts()
    {
        $this->view->params['link'] = 'contracts';

        $dataProvider = new ActiveDataProvider([
            'query' => Contract::getAll(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('contracts', ['contractsDataProvider' => $dataProvider]);
    }

    public function actionEditcontract(int $id)
    {
        $this->view->params['link'] = 'contracts';

        $modelForm = new Form2();
        if ($id > 0) {
            $contract = Contract::getOne($id);
            if (!$contract) throw new \yii\web\NotFoundHttpException();

            $modelForm->setAttributes($contract);
        }

        // populate model attributes with user inputs
        if ($data = \Yii::$app->request->post()) {
            $modelForm->load($data);

            if ($modelForm->validate()) {
                // all inputs are valid
                if ($id > 0) {
                    Yii::$app->db->createCommand()->update(Contract::$tableName, [
                        'name' => $modelForm->name,
                        'amount' => $modelForm->amount,
                    ], ['id' => $id])->execute();
                } else {
                    Yii::$app->db->createCommand()->insert(Contract::$tableName, [
                        'name' => $modelForm->name,
                        'amount' => $modelForm->amount,
                    ])->execute();
                }

                $this->redirect(Url::to('/shop/contracts'));
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $modelForm->errors;
            }
        }

        return $this->render('contract', ['modelForm' => $modelForm, 'contractId' => $id]);
    }

    public function actionDeletecontract(int $id) {
        $contact = Contract::getOne($id);
        if (!$contact) throw new \yii\web\NotFoundHttpException();

        Yii::$app->db->createCommand()->delete(Contract::$tableName, ['id' => $id])->execute();

        Yii::$app->db->createCommand()->delete(Deal::$tableName, ['contract' => $id])->execute();

        $this->redirect(Url::to('/shop/contracts'));
    }

    public function actionDeals() {
        $this->view->params['link'] = 'deals';

        $dataProvider = new ActiveDataProvider([
            'query' => Deal::getAll(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('deals', ['dealsDataProvider' => $dataProvider]);
    }

    public function actionEditdeal(int $id)
    {
        $this->view->params['link'] = 'deals';

        $modelForm = new Form3();
        if ($id > 0) {
            $deal = Deal::getOne($id);
            if (!$deal) throw new \yii\web\NotFoundHttpException();

            $modelForm->setAttributes($deal);
        }

        // populate model attributes with user inputs
        if ($data = \Yii::$app->request->post()) {
            $modelForm->load($data);

            if ($modelForm->validate()) {
                // all inputs are valid
                if ($id > 0) {
                    Yii::$app->db->createCommand()->update(Deal::$tableName, [
                        'contact' => $modelForm->contact,
                        'contract' => $modelForm->contract,
                    ], ['id' => $id])->execute();
                } else {
                    Yii::$app->db->createCommand()->insert(Deal::$tableName, [
                        'contact' => $modelForm->contact,
                        'contract' => $modelForm->contract,
                    ])->execute();
                }

                $this->redirect(Url::to('/shop/deals'));
            } else {
                // validation failed: $errors is an array containing error messages
                $errors = $modelForm->errors;
            }
        }

        $contacts = Contact::getAllForForm();
        $contracts = Contract::getAllForForm();

        return $this->render('deal', ['modelForm' => $modelForm, 'dealId' => $id, 'contacts' => $contacts, 'contracts' => $contracts]);
    }

    public function actionDeletedeal(int $id) {
        $contact = Deal::getOne($id);
        if (!$contact) throw new \yii\web\NotFoundHttpException();

        Yii::$app->db->createCommand()->delete(Deal::$tableName, ['id' => $id])->execute();
        $this->redirect(Url::to('/shop/deals'));
    }
}