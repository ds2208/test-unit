<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer(
        //     [
        //         'front.measurements.index',
        //         'front.measurements.single',
        //         'front.search.index',
        //         'front.index.index',
        //         'front.contact.index'
        //     ],
        //     function ($view) {
        //         $view->with(
        //             'footerMeasurements',
        //             Measurement::query()
        //                 ->where('status', '=', 1)
        //                 ->orderBy('created_at', 'DESC')
        //                 ->limit(3)
        //                 ->get()
        //         );
        //     }
        // );


        // View::composer(
        //     [
        //         'front.measurements.index',
        //         'front.measurements.single',
        //         'front.search.index',
        //         'front.contact.index',
        //         'front.index.index',
        //     ],
        //     function ($view) {
        //         $view->with(
        //             'latestMeasurements',
        //             Measurement::query()
        //                 //->where('status', '=', 1)
        //                 ->orderBy('created_at', 'DESC')
        //                 ->whereBetween('created_at', [
        //                     Carbon::now()->startOfMonth()->subMonth(2),
        //                     Carbon::now()->startOfMonth()
        //                 ])
        //                 ->withCount('comments')
        //                 ->limit(7)
        //                 ->get()
        //         );
        //     }
        // );
    }
}
