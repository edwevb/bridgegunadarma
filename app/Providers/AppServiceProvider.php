<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Blade;

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
      Schema::defaultStringLength(255);

      Validator::extend('alpha_spaces', function($attribute, $value)
      {
          // This will only accept alpha and spaces. 
          // If you want to accept hyphens use: /^[\pL\s-]+$/u.
          return preg_match('/^[\pL\s]+$/u', $value); 
      });

      // number_format($number = 2222.22 output => 2,222.22)
      Blade::directive('rupiah', function($expression)
          {
              return "Rp. <?php echo number_format($expression,2); ?>"; 
          });

      Blade::directive('file', function()
          {
              return "<?php echo 'application/pdf, application/zip, text/plain, application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, .xls, .xlsx, .odt, .ods, .rtf, .rar, .7z, .tar.gz, .tar, .tex, .htm, .html' ?>";
          });

      Blade::directive('popoverText', function()
          {
              return "<div class='no-overfolw lead'>
                <p class='lead'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam veritatis, obcaecati autem! Quibusdam dolor quam est, ad adipisci earum odit doloremque, velit tempore quisquam voluptatibus magni nam eos, delectus ipsam.</p>
                <a class='mb-2 text-center d-block' href='#'>Laporkan Kesalahan</a>
              </div>'";
          });
    }
}
