<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use \App\Models\User;
use Auth;

use Nwidart\Modules\Facades\Module;

class AppServiceProvider extends ServiceProvider
{
  
  /**
   * 
  */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(Dispatcher $events): void
  {      
    Schema::defaultStringLength(191);        
    //
        
    // $usersCount = User::count();        
    //dd(Auth::id());
        
    $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
      $event->menu->add([              
        'text'    => 'Dashboard',
        'url'     => 'admin',
        'icon'    => 'nav-icon fas fa-tachometer-alt',
        'classes' => 'text-sm',
        'can'     => 'Browse Admin',
      ]);
          
      $event->menu->add([
        'text'    => 'Manage Content',
        'can'     => 'Manage Content',
        'icon'    => 'nav-icon far fa-newspaper',
        'classes' => 'text-sm text-white',
        'submenu' => [
          [
            'text'    => 'Blogs',
            'icon'    => 'nav-icon fas fa-blog',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Blogs',
            'submenu' => [
              [
                'text'  => 'All Blogs',
                'url'   => 'admin/blogs',
                'icon'  => 'nav-icon far fa-list-alt',
                'classes' => 'ml-4 text-sm',
                'can'   => 'Manage Blogs',
              ],
              [
                'text'  => 'Add New Blog',
                'url'   => 'admin/blogs/create',
                'icon'  => 'nav-icon fas fa-file',
                'classes' => 'ml-4 text-sm',
                'can'   => 'Add Blogs',
              ],
              [
                'text'    => 'Categories',
                'url'     => 'admin/blog-categories',
                'icon'    => 'nav-icon fas fa-tags',
                'classes' => 'ml-4 text-sm',
                'can'     => 'Add Categories',
              ],
            ]
          ],
          [
            'text'    => 'Pages',
            'icon'    => 'nav-icon fas fa-file-alt',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Pages',
            'submenu' => [
              [
                'text'    => 'All Pages',
                'url'     => 'admin/pages',
                'icon'    => 'nav-icon fa fa-copy',
                'classes' => 'ml-4 text-sm',
                'can'     => 'Add Pages',
              ],
              [
                'text'    => 'Add New Page',
                'url'     => 'admin/pages/create',
                'icon'    => 'nav-icon fas fa-file',
                'classes' => 'ml-4 text-sm',
                'can'     => 'Add Pages',
              ],
            ]
          ],
          [
            'text'      => 'Media Manager',
            'url'       => 'admin/media-manager',
            'icon'      => 'nav-icon far fa-images',
            'classes'   => 'ml-2 text-sm',
            'can'       => 'Manage Media'
          ]
        ]
      ]);

      if( Module::isEnabled('Quiz') ) {
        $event->menu->add([
          'text'    => 'Quizzes',
          'icon'    => 'nav-icon fas fa-envelope',                    
          'classes' => 'text-sm',
          'can'     => 'Manage Newsletters',
          'submenu' => [
            [
              'text'    => 'All Quizzes',
              'url'     => 'admin/quizzes',
              'icon'    => 'nav-icon fa fa-envelope-open',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Bulk Email',
            ],
            [
              'text'    => 'Add New Quiz',
              'url'     => 'admin/quizzes/create',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscribers',
            ],
            [
              'text'    => 'Quiz Categories',
              'url'     => 'admin/quizzes/categories',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscribers',
            ],
          ]
        ]);


        $event->menu->add([
          'text'    => 'Polls',
          'icon'    => 'nav-icon fas fa-envelope',                    
          'classes' => 'text-sm',
          'can'     => 'Manage Newsletters',
          'submenu' => [
            [
              'text'    => 'All Polls',
              'url'     => 'admin/polls',
              'icon'    => 'nav-icon fa fa-envelope-open',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Bulk Email',
            ],
            [
              'text'    => 'Add New Poll',
              'url'     => 'admin/polls/create',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscribers',
            ],
          ]
        ]);



      }
        


      if( Module::isEnabled('Newsletter') ) {
        $event->menu->add([
          'text'    => 'Newsletters',
          'icon'    => 'nav-icon fas fa-envelope',                    
          'classes' => 'text-sm',
          'can'     => 'Manage Newsletters',
          'submenu' => [
            [
              'text'    => 'Bulk Email',
              'url'     => 'admin/newsletters/send-newsletter',
              'icon'    => 'nav-icon fa fa-envelope-open',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Bulk Email',
            ],
            [
              'text'    => 'Subscribers',
              'url'     => 'admin/newsletters/subscribers',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscribers',
            ],
          ]
        ]);
      }
        
      // Support
      if( Module::isEnabled('Support') ) {
        $event->menu->add([
          'text'    => 'Support',
          'icon'    => 'nav-icon fas fa-life-ring',
          'classes' => 'text-sm',
          'can'     => 'Manage Support',
          'submenu' => [
            [
              'text'    => 'Support Tickets',
              'url'     => 'admin/support/tickets',
              'icon'    => 'nav-icon fa fa-clipboard',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Tickets',
            ],
            [
              'text'    => 'Categories',
              'url'     => 'admin/support/categories',
              'icon'    => 'nav-icon fa fa-tags',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Ticket Categories',
            ],
            [
              'text'    => 'Settings',
              'url'     => 'admin/support/settings',
              'icon'    => 'nav-icon fa fa-cogs',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Support',
            ],
          ]
        ]);
      }

      if( Module::isEnabled('Subscription') ) { 
        $event->menu->add([
          'text'    => 'Subscriptions',
          'icon'    => 'nav-icon fas fa-bell',
          'classes' => 'text-sm',            
          'can'     => 'Manage Subscriptions',
          'submenu' => [
            [
              'text'    => 'Subscription Histories',
              'url'     => 'admin/subscriptions',
              'icon'    => 'nav-icon fa fa-list',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscriptions',
            ],
            [
              'text'    => 'Packages',
              'url'     => 'admin/subscriptions/packages',
              'icon'    => 'nav-icon fa fa-box',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscriptions Packages',
            ],
            [
              'text'    => 'Subscription Settings',
              'url'     => 'admin/subscriptions/settings',
              'icon'    => 'nav-icon fa fa-cogs',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Subscriptions',
            ],
          ]
        ]);
      }

      $event->menu->add([            
        'text'    => 'Members',            
        'icon'    => 'nav-icon fas fa-users',
        'classes' => 'text-sm',
        'can'     => 'Manage Members',          
        'submenu' => [
          [
            'text'    => 'Members',
            'url'     => 'admin/members',
            'icon'    => 'nav-icon fas fa-user',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Members',
          ],
          [            
            'text'    => 'Admins',
            'url'     => 'admin/members/admins',
            'icon'    => 'nav-icon fas fa-user-tie',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Admins',
          ],
          [
            'text'    => 'Roles',
            'url'     => 'admin/members/roles',
            'icon'    => 'nav-icon fas fa-user-lock',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Roles',
          ],
          [
            'text'    => 'Permissions',
            'url'     => 'admin/members/permissions',
            'icon'    => 'nav-icon fa fa-key',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Permissions',
          ]
        ]
      ]);
      
      if( Module::isEnabled('Affiliate') ) {
        $event->menu->add([
          'text'    => 'Affiliates',
          'icon'    => 'nav-icon fas fa-dollar-sign',
          'classes' => 'text-sm',            
          'can'     => 'Manage Affiliates',
          'submenu' => [
            [
              'text'    => 'Affiliates',
              'url'     => 'admin/affiliates',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Affiliates',
            ],
            [
              'text'    => 'Withdraw Requests',
              'url'     => 'admin/affiliates/withdraw-requests',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Withdraw Requests',
            ],
            [
              'text'    => 'Earning Histories',
              'url'     => 'admin/affiliates/earning-histories',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Earning Histories',
            ],
            [
              'text'    => 'Payment Histories',
              'url'     => 'admin/affiliates/payment-histories',
              'icon'    => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Payment Histories',
            ],
            [
              'text'    => 'Affiliate Settings',
              'url'     => 'admin/affiliates/affiliate-settings',
              'icon'   => 'nav-icon fa fa-users',
              'classes' => 'ml-2 text-sm',
              'can'     => 'Manage Affiliates Settings',
            ],
          ]
        ]);
      }

      // $event->menu->add([
      //   'header'  => 'Reports',
      //   'can'     => 'Browse Users', 
      //   'classes' => 'text-sm text-white'
      // ]);

      $event->menu->add([
        'text'    => 'Reports',
        'icon'    => 'nav-icon fas fa-chart-bar',
        'classes' => 'text-sm',            
        'can'     => 'Manage Reports',
        'submenu' => [
          [
            'text'    => 'Subscriptions Report',
            'url'     => 'admin/reports/subscription-report',
            'icon'    => 'nav-icon fa fa-bell',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Subscriptions Report',
          ],
        ]
      ]);      

      // $event->menu->add([            
      //   'header'  => 'Manage Appearance',
      //   'classes'   => 'text-sm text-white',
      //   'can'     => 'Browse Users',
      // ]);

      $event->menu->add([
        'text'    => 'Appearance',
        'icon'    => 'nav-icon fas fa-palette',
        'classes' => 'text-sm',            
        'can'     => 'Manage Appearance',
        'submenu' => [
          [
            'text'    => 'Theme Settings',
            'url'     => 'admin/appearance/theme-settings',
            'icon'    => 'nav-icon fas fa-sliders-h',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Appearance',
          ],
          [
            'text'    => 'Header Settings',
            'url'     => 'admin/appearance/header-settings',
            'icon'    => 'nav-icon fas fa-window-maximize',
            'classes' => 'ml-2 text-sm',
            'can'     => 'Manage Appearance',
          ],
          [
            'text'  => 'Footer Settings',
            'url'   => 'admin/appearance/footer-settings',
            'icon'  => 'nav-icon fa fa-table',
            'can'   => 'Manage Appearance',
            'classes' => 'ml-2 text-sm'
          ],
        ]
      ]);

      // $event->menu->add([            
      //   'header'  => 'Manage Settings',
      //   'classes' => 'text-sm text-white',
      //   'can'     => 'Browse Users',          
      // ]);
      $event->menu->add([
        'text'    => 'System Settings',
        'icon'    => 'nav-icon fas fa-cogs',
        'classes' => 'text-sm',
        'can'     => 'Manage Settings',
        'submenu' => [
          [
            'text'    => 'General Settings',
            'url'     => 'admin/settings/general-settings',
            'icon'    => 'nav-icon fa fa-cog',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Auth Settings',
            'url'     => 'admin/settings/auth-settings',
            'icon'    => 'nav-icon fa fa-key',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Mail Settings',
            'url'     => 'admin/settings/mail-settings',
            'icon'    => 'nav-icon fa fa-envelope',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Storage Settings',
            'url'     => 'admin/settings/storage-settings',
            'icon'    => 'nav-icon fa fa-cloud',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Cron Job Settings',
            'url'     => 'admin/settings/cronjob-settings',
            'icon'    => 'nav-icon fa fa-tasks',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Ads Settings',
            'url'     => 'admin/settings/ads-settings',
            'icon'    => 'nav-icon fa fa-ad',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Languages Settings',
            'url'     => 'admin/settings/language-settings',
            'icon'    => 'nav-icon fa fa-language',
            'classes' => 'ml-2 text-sm',
          ],
          [
            'text'    => 'Sitemap Settings',
            'url'     => 'admin/settings/sitemap-settings',
            'icon'    => 'nav-icon fas fa-sitemap',
            'classes' => 'ml-2 text-sm',
          ],
        ],
      ]);
      $event->menu->add([
        'text'    => 'Module Settings',
        'url'     => 'admin/modules',
        'icon'    => 'nav-icon fas fa-plug',         
        'classes' => 'text-sm',
        'can'     => 'Manage Utilities'
      ]);      
      $event->menu->add([
        'text'    => 'Utilities',
        'url'     => 'admin/utilities',
        'icon'    => 'nav-icon fas fa-tools',         
        'classes' => 'text-sm',
        'can'     => 'Manage Utilities'
      ]);
      $event->menu->add([
        'text'    => 'Log',
        'url'     => 'log-viewer',
        'icon'    => 'nav-icon far fa-clipboard',         
        'classes' => 'text-sm',
        'can'     => 'Manage Utilities',
        'target'  => '_blank',
      ]);

    });
  }
}
