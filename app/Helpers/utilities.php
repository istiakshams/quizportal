<?php
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Support\Facades\Artisan;

use App\Models\ThemeSettings;
use App\Models\SystemSettings;
use App\Models\User;
use App\Models\MediaManager;
use App\Models\Localization;
use App\Models\GeneralSetupLocalization;


if( !function_exists('getSetting') ) {
    function getSetting( $key, $default = null )
    {        
        if (is_null($key)) {
            return new SystemSettings();
        }

        if (is_array($key)) {
            return SystemSettings::set($key[0], $key[1]);
        }

        $value = SystemSettings::get($key);

        return is_null($value) ? value($default) : $value;
    }
}


if( !function_exists('isDefaultPage') ) {
    function isDefaultPage( $id )
    {        
        $defaultPageIds = array(1,2,3,4,5);

        if( in_array( $id, $defaultPageIds ) ) {
            return true;
        }
        
        return false;            
    }
}

if (! function_exists('getUserName')) {
    function getUserName( $id )
    {        
        $user = User::findOrFail($id);
        return $user->name;
    }
}


if (! function_exists('createDummyImage')) {

    function createDummyImage( $img_name, $text, $destination, $width, $height, $max_len = 36 )
    {

        $manager = new ImageManager(Driver::class);

        // $width = 600;
        // $height = 300;
        $center_x = $width / 2;
        $center_y = $height / 2;
        // $max_len = 36;
        $font_size = 24;
        $font_height = 20;

        // $text = 'The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog?';

        $lines = explode( "\n", wordwrap($text, $max_len) );
        $y = $center_y - ( (count($lines) - 1) * $font_height );

        // Create from dummy image
        // $img   = \Image::canvas($width, $height, '#777');
        // $img = Image::make(public_path('images/dummy.jpg'))->resize($width, $height);
        $image = $manager->create($width, $height)->fill('#E2E8F0');

        foreach( $lines as $line ) {

          $image->text( $line, $center_x, $y, function($font) use ($font_size) {
            $font->file(public_path('fonts/Montserrat-ExtraBold.ttf'));
            $font->size($font_size);
            $font->color('#082150');
            $font->align('center');
            $font->valign('middle');
          });
          $y += $font_height * 2;
        }

        $image->save( $destination . "/" . $img_name );
    }

}

if (!function_exists('uploadedAsset')) {
    #  Generate an asset path for the uploaded files.
    function uploadedAsset($fileId)
    {
        if (!$fileId) return null;
        $mediaFile = MediaManager::find($fileId);
        if (!is_null($mediaFile)) {
            if (strpos(url('/'), '.test') !== false || strpos(url('/'), 'http://127.0.0.1:') !== false) {
                return app('url')->asset('/uploads/' . $mediaFile->media_file);
            }
            return app('url')->asset('public/' . $mediaFile->media_file);
        }
        return '';
    }
}

if (!function_exists('staticAsset')) {
    # return path for static assets
    function staticAsset($path, $secure = null)
    {
        if (strpos(url('/'), '.test') !== false || strpos(url('/'), 'http://127.0.0.1:') !== false) {
            return app('url')->asset($path, $secure) . '?v=' . env('APP_VERSION');
        }
        return app('url')->asset('images/' . $path, $secure) . '?v=' . env('APP_VERSION');
    }
}

if (!function_exists('paginationNumber')) {
    # return number of data per page
    function paginationNumber($value = null)
    {
        return $value != null ? $value : env('DEFAULT_PAGINATION');
    }
}

if (!function_exists('getFileType')) {
    #  Get file Type
    function getFileType($type)
    {
        $fileTypeArray = [
            // audio
            "mp3"       =>  "audio",
            "wma"       =>  "audio",
            "aac"       =>  "audio",
            "wav"       =>  "audio",

            // video
            "mp4"       =>  "video",
            "mpg"       =>  "video",
            "mpeg"      =>  "video",
            "webm"      =>  "video",
            "ogg"       =>  "video",
            "avi"       =>  "video",
            "mov"       =>  "video",
            "flv"       =>  "video",
            "swf"       =>  "video",
            "mkv"       =>  "video",
            "wmv"       =>  "video",

            // image
            "png"       =>  "image",
            "svg"       =>  "image",
            "gif"       =>  "image",
            "jpg"       =>  "image",
            "jpeg"      =>  "image",
            "webp"      =>  "image",

            // document
            "doc"       =>  "document",
            "txt"       =>  "document",
            "docx"      =>  "document",
            "pdf"       =>  "document",
            "csv"       =>  "document",
            "xml"       =>  "document",
            "ods"       =>  "document",
            "xlr"       =>  "document",
            "xls"       =>  "document",
            "xlsx"      =>  "document",

            // archive
            "zip"       =>  "archive",
            "rar"       =>  "archive",
            "7z"        =>  "archive"
        ];
        return isset($fileTypeArray[$type]) ? $fileTypeArray[$type] : null;
    }
}


if (!function_exists('localize')) {
    # add / return localization
    function localize($key, $lang = null, $localize = true)
    {
        if ($localize == false) {
            return $key;
        }

        if ($lang == null) {
            $lang = App::getLocale();
        }

        $t_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

        $localization_english = Cache::rememberForever('localizations-en', function () {
            return Localization::where('lang_key', 'en')->pluck('t_value', 't_key');
        });

        if (!isset($localization_english[$t_key])) {
            # add new localization
            newLocalization('en', $t_key, $key);
        }

        # return user session lang
        $localization_user = Cache::rememberForever("localizations-{$lang}", function () use ($lang) {
            return Localization::where('lang_key', $lang)->pluck('t_value', 't_key')->toArray();
        });

        if (isset($localization_user[$t_key])) {
            return trim($localization_user[$t_key]);
        }

        return isset($localization_english[$t_key]) ? trim($localization_english[$t_key]) : $key;
    }
}

if (!function_exists('newLocalization')) {
    # new localization
    function newLocalization($lang, $t_key, $key, $type = null)
    {
        $localization = new Localization;
        $localization->lang_key = $lang;
        $localization->t_key = $t_key;
        $localization->t_key = $t_key;
        $localization->t_value = str_replace(array("\r", "\n", "\r\n"), "", $key);
        $localization->save();

        # clear cache
        Cache::forget('localizations-' . $lang);

        return trim($key);
    }
}

if (!function_exists('fileDelete')) {
    # file delete
    function fileDelete($file)
    {
        if (File::exists('public/' . $file)) {
            File::delete('public/' . $file);
        }
    }
}

if (!function_exists('formatPlucked')) {
    # Get formatted data
    function formatPlucked($data)
    {
        $data = str_replace( array('[',']'), '', $data->pluck('name'));
        $data = str_replace( array('",'), ', ', $data);
        $data = str_replace( array('"'), '', $data);
        return $data;
    }
}


// Write to .env
if (!function_exists('writeToEnvFile')) {
    # write To Env File
    function writeToEnvFile($type, $val)
    {
        Artisan::call('config:clear');

        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';

            if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace(
                    $type . '="' . env($type) . '"',
                    $type . '=' . $val,
                    file_get_contents($path)
                ));
            } else {
                file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
            }
        }
    }
}

// PHP SendMail
if (!function_exists('sendMail')) {
    function sendMail($receiverEmail, $receiverName, $type, $data = [])
    {
        $senderEmail  = env('MAIL_FROM_ADDRESS');
        $senderName   = env('MAIL_FROM_NAME');
        $email_driver = env('MAIL_MAILER');
        $template     = EmailTemplate::where('type', $type)->where('is_active', 1)->first();
        if (!$template) return false;
        $subject = $template->subject;
        $body    = EmailTemplate::emailTemplateBody($template->code, $data);
        try {

            Mail::send('emails.emailBody', compact('body'), function ($message) use ($receiverEmail, $receiverName, $senderName, $senderEmail, $subject) {
                $message->to($receiverEmail, $receiverName)->subject($subject);
                $message->from($senderEmail, $senderName);
            });
        } catch (\Throwable $th) {          
            Log::info('send mail issues :'.$th->getMessage());
        }
    }
}

// Get Localization
if (!function_exists('GetLocalization')) {
    function GetLocalization($lang_key, $t_key)
    {
        $localization_lang = Localization::where('lang_key', $lang_key)
                                        ->where('t_key', $t_key)
                                        ->latest()
                                        ->first();

        
        // echo $localization_lang;
                                        return $localization_lang;
    }
}