<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SeedInitialData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setting environment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Setting up production environment');

        $this->migrateDatabase();
        $this->generateKey();
        $this->createPermissions();
        $this->createRoles();
        $this->createDefaultUser();

        $this->info('Everything is done, congratulations! 🥳🥳🥳');
    }

    /**
     * generate default users
     */

    public function createDefaultUser()
    {
        $this->line('-- Seeding User Data');

        $admin = \App\Models\User::where('email' , 'admin@admin.com')->first();

        if (!$admin)
        {
            $admin = \App\Models\User::create([
                'name'      => 'admin',
                'username'  => 'superadmin',
                'password'  => bcrypt('password'),
                'email'     => 'admin@admin.com',
                'status_id' => 1,
            ]);

            $admin->assignRole('superadmin');
        }
    }


    /**
     * generate key
     */
    public function generateKey()
    {
        $this->call('key:generate');
    }

    /**
     * Migrate database
     */
    public function migrateDatabase()
    {
        $this->call('migrate');
    }

    /**
     * generate Permissions
     */
    public function createPermissions()
    {
        $this->line('-- Seeding Permission');

        //Seed Permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'view_setting']);
        Permission::firstOrCreate(['name' => 'manage_profile']);
        Permission::firstOrCreate(['name' => 'view_user']);
        Permission::firstOrCreate(['name' => 'create_user']);
        Permission::firstOrCreate(['name' => 'edit_user']);
        Permission::firstOrCreate(['name' => 'delete_user']);
        Permission::firstOrCreate(['name' => 'update_userstatus']);
        Permission::firstOrCreate(['name' => 'reset_user_password']);

        //Enquiry
        Permission::firstOrCreate(['name' => 'view_enquiry']);
        Permission::firstOrCreate(['name' => 'delete_enquiry']);
        Permission::firstOrCreate(['name' => 'convert_enquiry']);

        //Contact
        Permission::firstOrCreate(['name' => 'view_contact']);
        Permission::firstOrCreate(['name' => 'create_contact']);
        Permission::firstOrCreate(['name' => 'edit_contact']);
        Permission::firstOrCreate(['name' => 'delete_contact']);

        //Quotation
        Permission::firstOrCreate(['name' => 'view_quotation']);
        Permission::firstOrCreate(['name' => 'send_quotation']);
        Permission::firstOrCreate(['name' => 'status_quotation']);
        Permission::firstOrCreate(['name' => 'view_invoice']);
        Permission::firstOrCreate(['name' => 'create_invoice']);
        Permission::firstOrCreate(['name' => 'edit_invoice']);
        Permission::firstOrCreate(['name' => 'email_invoice']);
        Permission::firstOrCreate(['name' => 'delete_invoice']);
        Permission::firstOrCreate(['name' => 'store_quotation']);


        //Portfolio
        Permission::firstOrCreate(['name' => 'view_portfolio']);
        Permission::firstOrCreate(['name' => 'add_portfolio']);
        Permission::firstOrCreate(['name' => 'update_portfolio']);
        Permission::firstOrCreate(['name' => 'delete_portfolio']);

        //job

        Permission::firstOrCreate(['name' => 'manage_job']);
        Permission::firstOrCreate(['name' => 'view_job']);
        Permission::firstOrCreate(['name' => 'add_job']);
        Permission::firstOrCreate(['name' => 'update_job']);
        Permission::firstOrCreate(['name' => 'delete_job']);
        Permission::firstOrCreate(['name' => 'bid_job']);
        Permission::firstOrCreate(['name' => 'manage_bid_job']);

        Permission::firstOrCreate(['name' => 'change_profile_picture']);

        Permission::firstOrCreate(['name' => 'manage_domain']);




        $this->info('-- Permission Seed Completed');
    }

     /**
     * generate Roles
     */
    public function createRoles()
    {
        $this->line('-- Seeding Role Data');

        $role = Role::firstOrCreate( ['name' => 'superadmin'] );
        $role->givePermissionTo(Permission::all());

        $role = Role::firstOrCreate( ['name' => 'admin'] );
        $role->givePermissionTo(Permission::all());

        $this->info('-- Role Seed Completed');

        $this->line('-- Seeding Support Tables Data');

        \App\Models\User\UserStatus::firstOrCreate( ['name' => 'active', 'color' => 'success' ] );
        \App\Models\User\UserStatus::firstOrCreate( ['name' => 'inactive', 'color' => 'warning' ] );
        \App\Models\User\UserStatus::firstOrCreate( ['name' => 'suspended', 'color' => 'danger' ] );

        \App\Models\User\Gender::firstOrCreate( ['name' => 'male', 'color' => 'success' ] );
        \App\Models\User\Gender::firstOrCreate( ['name' => 'female', 'color' => 'success' ] );
        \App\Models\User\Gender::firstOrCreate( ['name' => 'other', 'color' => 'success' ] );


        $this->info('-- Table Data Seed Completed');
    }

}
