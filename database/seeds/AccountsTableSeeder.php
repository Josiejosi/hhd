<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<11;$i++) {
            $receiver     = mt_rand( 1, 10 ) ;
            $amount       = mt_rand( 650, 20000 ) ;
            $bank         = [
                                'Absa Bank',
                                'African Bank',
                                'Capitec Bank',
                                'First National Bank',
                                'Nedbank',
                                'Standard Bank'
                            ] ;
                            
            DB::table('accounts')->insert([
                "branch_code"        => mt_rand(111111,666666),
                "bank"               => $bank[mt_rand(0, count($bank)-1)],
                "account_number"     => mt_rand(111111111,666666666),
                "active_account"     => 1,
                "user_id"            => $i
            ]);
        }
    }
}
