
# Symfony 5 ile Blog Yönetim Projesi

### Öncelikle proje kurulumu için aşağıda belirtilen Sistem gereksinimine ihtiyacımız var, 
Bunların bilgisayarınızda (sunucunuzda) yüklü olması gerekir. Eğer yüklü değilse gerekli paketleri yükleyin
aşağıda versiyonları ile belirtilmiştir.
### SİSTEM GEREKSİNİMLERİ
+ PHP : >= 7.2.5 
+ PHP Extentions : Curl,ZIP,XML, mbstring,mysql,fpm
+ Apache : 2.4.52 Veya Nginix : >= 1.x 
+ Database : MySQL >= 5.7.* 
+ NPM : 9.6.7 NODE : >=18.* 
+ Composer : 2 +
+ Symfony CLI : https://symfony.com/download

### KULLANILAN COMPOSER PAKETLERİ LISTESİ
********************************
+ sg/datatablesbundle 
+ friendsofsymfony/ckeditor-bundle 
+ symfony/security-bundle 
+ symfony/security-csrf 
+ symfony/serializer 
+ symfony/validator 
+ symfony/webpack-encore-bundle 
+ sensio/framework-extra-bundle 
+ vich/uploader-bundle 
+ symfony/maker-bundle


## KURULUM AŞAMALARI
***
#### Adım 1- Repoyu yerel sisteminize klonlayın. Aşağıdaki komut ile:
* git clone git@github.com:serkansyalcin/blog-management.git cd blog-management

#### Adım 2 - Composer Paketlerinin Kurulumu
 * composer inistall
#### Adım 3 - NODE JS Paketleri kurulumu
* npm install
#### Adım 4 - Assets Oluşturun
* npm run build
* php bin/console assets:install public
#### Adım 5- ENV ve Veritabanı Kurulumu
mysql'de "BlogManagement" adıyla yeni bir veritabanı oluşturun ve güncelleyin
.env dosya yapılandırması.
Veritabanı tablolarını oluşturmak için aşağıdaki komutu kullanın.
* php bin/console d:s:u –force
#### Adım - 6 Tarayıcıda yerel olarak uygulamayı çalıştırmak için:
* symfony serve
* sistemi tarayıcıda URI ile açmak için https://127.0.0.1:8000/
#### Adım 7 - Canlı ortamda sunucuya dağıtmak için:
* Sunucu virtual host yolunuzu public/index.php adresine yönlendirin.
