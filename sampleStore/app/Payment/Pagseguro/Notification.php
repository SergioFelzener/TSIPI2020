<?php


namespace App\Payment\Pagseguro;


class Notification {

    public function getTransaction(){

        if (!\PagSeguro\Helpers\Xhr::hasPost()) throw new \InvalidArgumentException($_POST);
            $response = \PagSeguro\Services\Transactions\Notification::check(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

        return $response;


    }



}
