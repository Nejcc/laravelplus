<?php

declare(strict_types=1);

if (!function_exists('getAllLocales')) {

    function getAllLocales(): array
    {
        return App\Helpers\Utilities\GetLocales::all();
    }
}

if (!function_exists('getLocaleByName')) {

    function getLocaleByName(string $name): array
    {
        return App\Helpers\Utilities\GetLocales::get($name);
    }
}

if (!function_exists('my_role')) {
    /**
     * @return Illuminate\Contracts\Auth\Authenticatable|null|string
     */
    function my_role()
    {
        return cache()->rememberForever('my_role_' . auth()->id(), function () {
            if (!empty(auth()->user()->roles()->pluck('name')[0])) {
                return mb_strtolower(auth()->user()->roles()->pluck('name')[0]);
            }

            return '-';
        });
    }
}

if (!function_exists('update_usage_interface')) {

    function update_usage_interface(string $name = 'default', int $cacheTimeInSeconds = 60): void
    {
        /*
         *  THIS YOU PUT ONLY ON VIEW (INDEX, CREATE, SHOW, EDIT)
         */

        $routes = getDictionaryOfUsageinterface();
        $route_name = request()->route()->uri();

        $route_name_serialized = Illuminate\Support\Str::slug($route_name);

        $user = me();
        $user_id = $user->id;

        if ($user->last_login_at !== null) {
            // Parse the last login time to a Carbon instance
            $lastLoginTime = Carbon::parse($user->last_login_at);

            // Get the current time
            $currentTime = Carbon::now();

            // Calculate the difference in minutes between the current time and the last login time
            $minutesSinceLastLogin = $currentTime->diffInMinutes($lastLoginTime);

            // If it has been more than 1 minute, update the last_login_at attribute
            if ($minutesSinceLastLogin > 1) {
                $user->last_login_at = $currentTime;
                $user->save();
            }
        }

        cache()->remember('IU_' . $route_name_serialized . '_' . $user_id, $cacheTimeInSeconds, function () use ($route_name, $user_id, $routes): void {

            $model = App\Models\InterfaceUsage::firstOrCreate([
                'user_id' => $user_id,
                'name' => $routes[$route_name], // dodaj route v dictionary getDictionaryOfUsageinterface()
                'route_name' => $route_name,
                'year' => date('y'),
                'month' => date('m'),
                'day' => date('d'),
            ], [
                'cnt' => 1,
            ]);

            if (empty($model->name)) {
                $model->name = $routes[$route_name];
            }

            $model->cnt = $model->cnt + 1;
            $model->save();
        });
    }
}

if (!function_exists('aboart_if_cannot')) {

    function aboart_if_cannot(string $permission_name)
    {
        return abort_if(cannot($permission_name), 403, 'You dont have the required  <br>[' . $permission_name . ']<br> permissions to view this resource');
    }
}

if (!function_exists('cannot')) {

    function cannot($permission): bool
    {
        return !auth()->user()->can($permission);
    }
}

if (!function_exists('vd')) {

    function vd(...$dump): void
    {
        var_dump($dump);
    }
}

if (!function_exists('db')) {

    function db(string $query, string $connection = 'mysql'): array
    {
        return Illuminate\Support\Facades\DB::connection($connection)->select($query);
    }
}

if (!function_exists('dbfirst')) {

    function dbfirst(string $query, string $connection = 'mysql')
    {
        return Illuminate\Support\Facades\DB::connection($connection)->selectOne($query);
    }
}

if (!function_exists('slug')) {

    function slug($string)
    {
        return Str::slug($string);
    }
}

if (!function_exists('ndd')) {
    /**
     * @param  mixed  ...$vars
     */
    function ndd(...$vars): void
    {
        foreach ($vars as $v) {
            Symfony\Component\VarDumper\VarDumper::dump($v);
        }
    }
}
