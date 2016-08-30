<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$name 						= ['Jon','Bob', 'Sam', 'Chris','Brian','Tom','Jack','Jessy','Wil','Dan'] ;
    	$surnames 					= ['Peters','Run','Davids','Han','Jacobs','Lewis','Johnson','Stark','Zyk','Adams'] ;
    	for ( $i=1;$i<11;$i++ ) {

    		$n 						= $name[mt_rand(0,count($name)-1)] ;
    		$s 						= $surnames[mt_rand(0,count($surnames)-1)] ;
    		$e 						= $n.$s."@gmail.com" ;

	        DB::table('users')->insert([
		        'first_name'		=>	$n, 
		        'last_name'			=>	$s, 
		        'email'				=>	$e, 
		        'cell_phone'		=>	"27".mt_rand(8,8).mt_rand(1,4).mt_rand(1111111,9999999), 
		        'avatar'			=>	"avatar.png", 
		        'timezone'			=>	"Africa/Johannesburg", 
		        'is_special_user'	=>	1, 
		        'is_verified'		=>	1, 
		        'verification_code'	=>	mt_rand(11111,666666), 
		        'password'			=>	bcrypt('password'),
		        'is_active'			=> 1,
	        ]);

    	}
    }
}
