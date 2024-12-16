<?php

namespace App\Services;

use App\Models\Accounts;
use App\Models\TransactionHistory;
use Carbon\Carbon;

class ATMService {

    /*
    ***************************
      LIST OF THE FUNCTIONS IN ATM
    ***************************
    */
    public function withdraw($userID, $withDrawAmount)
    {
        try {

            $accountData = Accounts::where('userID', $userID)->first();

            // guard conditions

            if(!$accountData) {
                return 'No Account Found!';
            }

            if($withDrawAmount > $accountData->accountBalance) {
                return 'Withdraw Amount is larger than the Account Balance!';
            }

            if($withDrawAmount <= 0) {
                return 'Invalid Withdraw Amount!';
            }

            // Update Accounts Table
            Accounts::where('userID', $userID)->update([
                'accountBalance' => $accountData->accountBalance - $withDrawAmount
            ]);

            // Insert data into transaction history when a user performs something
            $this->insertTransactionHistoryData('Withdraw', $withDrawAmount, 1);
            return 'Withdraw Completed!';

        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function deposit($userID, $depositAmount)
    {
        try {

            $accountData = Accounts::where('userID', $userID)->first();

            // guard conditions

            // check if acount exists
            if(!$accountData) {
                return 'No Account Found!';
            }

            // check if the deposit amount is valid
            if($depositAmount <= 0) {
                return 'Invalid Deposit Amount!';
            }

            Accounts::where('userID', $userID)->update([
                'accountBalance' => $accountData->accountBalance + $depositAmount
            ]);

            // insert transaction history for deposit
            $this->insertTransactionHistoryData('Deposit', $depositAmount, $accountData->id);

            return 'Deposit Completed!';

        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function balanceInquiry()
    {
        try {

        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /*
    ***************************
        UNROUTED FUNCTIONS
    ***************************
    */

    public function insertTransactionHistoryData($transactionType, $amount, $accountID)
    {
        try {

            // Insert yung data per transaction
            TransactionHistory::create([
                'accountID' => $accountID,
                'transactionType' => $transactionType,
                'amount' => $amount != null ? $amount : 0,
                'transactionDate' => Carbon::now()->toDateString()
            ]);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
