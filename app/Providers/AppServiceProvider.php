<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Atype;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
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
        $data['triathlon'] =Atype::where('atp_parent',2)->get();
        $data['gym'] =Atype::where('atp_parent',1)->get();
        $data['eatclean'] =Atype::where('atp_parent',3)->get();
        $data['type']=Atype::all();
        $data['cate']=Category::where('cate_parent',0)->get();
        $data['catename']=Category::all();
        // dd($data['type']);
        view()->share($data);
    }
}
