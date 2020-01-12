<?php

use Illuminate\Database\Seeder;
use App\AltaySettings;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create();

        $setting = new AltaySettings;
        $setting->name = 'planning_car';
        $setting->text = 'Стаж вождения от 3х лет. Лицензированные водители.';
        $setting->save();

        
        $setting = new AltaySettings;
        $setting->name = 'planning_photo';
        $setting->text = 'Живописная природа. Остановки по Вашему желанию.';
        $setting->save();

        
        $setting = new AltaySettings;
        $setting->name = 'planning_coins';
        $setting->text = 'Отмена заказа за сутки до поездки без штрафа.';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'planning_time';
        $setting->text = 'Цены ниже рыночных. Оплата после поездки';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'planning_transfer';
        $setting->heading = 'ТРАНСФЕР.';
        $setting->text = 'Не знаете где отдохнуть летом на Алтае в 2019 году? У нас собрана широкая база достопремичательнойстей Алтая: Озеро Ая, Телецкое, Чемал, Манжерок и другие... Водители местные, знают каждый уголок. Подскажут где можно можно вкусно и недорого поесть, где переночевать. Вы можете выбрать тур или составить свой маршрут.


Заберем вас из любой точки и доставим по месту назначения. После поездки можете оставить отзыв о работе водителя. Наш трансфер также берет детей. Чтобы узнать где лучше отдохнуть, можете ознакомитсья со списком мест, в которые может доставить наш трансфер.';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'about_rest';
        $setting->heading = 'Отдых.';
        $setting->text = 'Если вы не знаете куда съездить на Алтае, где отдохнуть. Хотите попутешествовать в 2019 году или просто вам нужно ‘такси’ чтобы добраться из одной точки Алтая в другую, то наш сайт поможет вам в этом. Берем детей.

Поможем с путешествием из Новосибирска, Барнаула, СПБ, Москвы и других городов, на машине.

Работаем круглый год: летом, осенью, зимой и весной.';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'about_onaltai';
        $setting->heading = 'На Алтае.';
        $setting->text = 'Алтай полон достопримечательностей и уже долгое время пользуется большой популярностью у отдыхающих.

Белуха, Чертов палец, Озеро Ая, Чемал и другие провереннные туристами красивые места отдыха. Наш трансфер позволит дешего перемещаться по Алтаю на машине.';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'about_family';
        $setting->heading = 'Семьей.';
        $setting->text = 'Отдых на Алтаей прекрасный повод отдохнуть всей семьей, возьмите детей, любимую собаку и заряжайтесь энергией природы.

Алтай это прекрасное лечебное место.';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'contacts_phone';
        $setting->heading = 'Телефон:';
        $setting->text = '+7 (495) 245 32 60';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'contacts_mail';
        $setting->heading = 'Почта:';
        $setting->text = 'suport@altaycross.ru';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'contacts_vk';
        $setting->heading = 'vk:';
        $setting->text = 'suport@altaycross.ru';
        $setting->save();

        $setting = new AltaySettings;
        $setting->name = 'contacts_facebook';
        $setting->heading = 'facebook:';
        $setting->text = 'facebook.com/groups/altaycross';
        $setting->save();


    }
}
