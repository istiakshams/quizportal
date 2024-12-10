<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{

    # init installation
    public function index()
    {

        $this->writeToEnvFile('APP_URL', URL::to('/'));
        return view('setup.index');
    }

    # checklist
    public function checklist()
    {
        $permission['curl_enabled']           = function_exists('curl_version');
        $permission['file_get_contents']      = function_exists('file_get_contents');
        $permission['file_put_contents']      = function_exists('file_put_contents');
        $permission['db_file_write_perm']     = is_writable(base_path('.env'));
        $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));
        $permission['server_connection']      = true;
        // dd($permission);
        return view('setup.checklist', compact('permission'));
    }

    
    # db form
    public function databaseSetup($error = "")
    {
        if ($error == "") {
            return view('setup.dbSetup');
        } else {
            return view('setup.dbSetup', compact('error'));
        }
    }

    # db store
    public function storeDatabaseSetup(Request $request)
    {

        if ($this->checkDatabaseConnection($request->DB_HOST, $request->DB_DATABASE, $request->DB_USERNAME, $request->DB_PASSWORD)) {
            $path = base_path('.env');

            if (file_exists($path)) {

                foreach ($request->types as $type) {
                    $this->writeToEnvFile($type, $request[$type]);
                }
                return redirect('db-migration');
            } else {
                // fallback
                return redirect('database-setup');
            }
        } else {
            // db connection error
            return redirect('database-setup/database_error');
        }
    }

    # overwrite env file
    public function writeToEnvFile($key, $value)
    {

        $env = file_get_contents(base_path() . '/.env');
        $env = explode("\n", $env);
        foreach ($env as $env_key => $env_value) {
            $entry = explode("=", $env_value, 2);

            if ($entry[0] === $key) {
                $env[$env_key] = $key . "=" . (is_string($value) ? '"' . $value . '"' : $value);
            } else {
                $env[$env_key] = $env_value;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path() . '/.env', $env);

        return true;
    }

    # check db connection
    function checkDatabaseConnection($db_host = "", $db_name = "", $db_user = "", $db_pass = "")
    {
        if (@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        } else {
            return false;
        }
    }

    # db migration confirmation view
    public function dbMigration()
    {
        // try {
        //     if ($this->checkDatabaseConnection(env('DB_HOST'), env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'))) {
        //         return view('setup.dbMigration');
        //     } else {
        //         // db connection error
        //         return redirect('database-setup/database_error');
        //     }
        // } catch (\Throwable $th) {
        //     return redirect('database-setup/database_error');
        // }
        return view('setup.dbMigration');
    }

    # run db migration
    public function runDbMigration($demo = false)
    {
        # run migrations  here            
        Artisan::call('migrate:refresh');
                
        # import templates            
        // $templatesController = new TemplatesController();            
        // $templatesController->store();
            
        # run seeds here            
        Artisan::call('db:seed');

        dd("DB DONE");
        // cacheClear();
        return redirect()->route('installation.storeAdminForm');
    }

    # add admin form view
    public function storeAdminForm()
    {
        if ($this->checkDatabaseConnection(env('DB_HOST'), env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'))) {
            return view('setup.adminConfig');
        } else {
            // db connection error
            return redirect('database-setup/database_error');
        }
    }

    # admin configuration
    public function storeAdmin(Request $request)
    {
        // $user = User::where('user_type', 'admin')->first();
        // $user->name      = $request->admin_name;
        // $user->email     = $request->admin_email;
        // $user->password  = Hash::make($request->admin_password);
        // $user->email_verified_at = date('Y-m-d H:m:s');
        // $user->save();

        $oldRouteServiceProvider        = base_path('app/Providers/RouteServiceProvider.php');
        $setupRouteServiceProvider      = base_path('app/Providers/SetupServiceComplete.php');

        copy($setupRouteServiceProvider, $oldRouteServiceProvider);
        return view('setup.complete');
    }
}

