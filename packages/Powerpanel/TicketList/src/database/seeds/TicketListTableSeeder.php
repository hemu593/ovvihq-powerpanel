<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Helpers\MyLibrary;
use App\Http\Traits\slug;

class TicketListTableSeeder extends Seeder {

    public function run() {
        $pageModuleCode = DB::table('module')->select('id')->where('varTitle', 'Submit Tickets')->first();

        if (!isset($pageModuleCode->id) || empty($pageModuleCode->id)) {
            if (\Schema::hasColumn('module', 'intFkGroupCode')) {
                DB::table('module')->insert([
                    'intFkGroupCode' => '4',
                    'varTitle' => 'Submit Tickets',
                    'varModuleName' => 'submit-tickets',
                    'varTableName' => 'ticket_master',
                    'varModelName' => 'SubmitTickets',
                    'varModuleClass' => 'SubmitTicketsController',
                    'varModuleNameSpace' => 'Powerpanel\TicketList\\',
                    'decVersion' => 1.0,
                    'intDisplayOrder' => 0,
                    'chrIsFront' => 'N',
                    'chrIsPowerpanel' => 'Y',
                    'varPermissions' => 'list, delete',
                    'chrPublish' => 'Y',
                    'chrDelete' => 'N',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            } else {
                DB::table('module')->insert([
                      'varTitle' => 'Submit Tickets',
                    'varModuleName' => 'submit-tickets',
                    'varTableName' => 'ticket_master',
                    'varModelName' => 'SubmitTickets',
                    'varModuleClass' => 'SubmitTicketsController',
                    'varModuleNameSpace' => 'Powerpanel\TicketList\\',
                    'decVersion' => 1.0,
                    'intDisplayOrder' => 0,
                    'chrIsFront' => 'N',
                    'chrIsPowerpanel' => 'Y',
                    'varPermissions' => 'list, delete',
                    'chrPublish' => 'Y',
                    'chrDelete' => 'N',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }

            $pageModuleCode = DB::table('module')->where('varTitle', 'Submit Tickets')->first();
            $permissions = [];
            foreach (explode(',', $pageModuleCode->varPermissions) as $permissionName) {
                $permissionName = trim($permissionName);
                $Icon = $permissionName;

                if ($permissionName == 'list') {
                    $Icon = 'per_list';
                } elseif ($permissionName == 'delete') {
                    $Icon = 'per_delete';
                } 
                array_push($permissions, [
                    'name' => $pageModuleCode->varModuleName . '-' . $permissionName,
                    'display_name' => $Icon,
                    'description' => ucwords($permissionName) . ' Permission',
                    'intFKModuleCode' => $pageModuleCode->id
                ]);
            }

            foreach ($permissions as $key => $value) {
                $id = DB::table('permissions')->insertGetId($value);
                for ($roleId = 1; $roleId <= 3; $roleId++) {
                    $value = [
                        'permission_id' => $id,
                        'role_id' => $roleId,
                    ];
                    DB::table('permission_role')->insert($value);
                }
            }
        }
    }

}
