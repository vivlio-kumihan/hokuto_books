お世話になります。
以下の内容で問題が発生しております。
お力添えをいただけるか、まずはご判断いただけましたら幸いです。

---

現在、レンタルサーバーにあるWPサイトとDBをDLしてローカルで再構築中です。
状況は、本体のページとリンクされているページは表示できています。
また、そのダッシュボード（/hokuto-bs/wp-admin/my-site.php）にもアクセスできており、各種作業（投稿・メディア・プラグインの追加や設定の変更など）はできております。

http://localhost:8888/hokuto-bs/
http://localhost:8888/hokuto-bs/wp-admin/

問題は、サイトネットワーク管理で連携している、投稿の2つのWPです。
表示はできます。インデックスページから個別投稿ページへも遷移できます。
解決できていないのは、ダッシュボード（/hokuto-bs/book/wp-admin/、/hokuto-bs/news/wp-admin/）に遷移できません。

http://localhost:8888/hokuto-bs/book/wp-admin/
http://localhost:8888/hokuto-bs/news/wp-admin/

こちらにアクセスすると、

```
Not Found
The requested URL was not found on this server.
```

となってしまいます。


## 確認したこと

`wp_blogs`・`wp_site`・`wp_sitemeta`・`wp_2_options`・`wp_3_options` の設定は確認済みです。

### wp_blogs

| blog_id | site_id | domain         | path             |
| ------- | ------- | -------------- | ---------------- |
| 1       | 1       | localhost:8888 | /hokuto-bs/      |
| 2       | 1       | localhost:8888 | /hokuto-bs/book/ |
| 3       | 1       | localhost:8888 | /hokuto-bs/news/ |

### wp_site

| id  | domain         | path        |
| --- | -------------- | ----------- |
| 1   | localhost:8888 | /hokuto-bs/ |

### wp_sitemeta

| meta_key | path                             |
| -------- | -------------------------------- |
| siteurl  | http://localhost:8888/hokuto-bs/ |

### wp_2_options

| option_name | option_value                          |
| ----------- | ------------------------------------- |
| siteurl     | http://localhost:8888/hokuto-bs/book/ |

| option_name | option_value                          |
| ----------- | ------------------------------------- |
| home        | http://localhost:8888/hokuto-bs/book/ |

### wp_3_options

| option_name | option_value                          |
| ----------- | ------------------------------------- |
| siteurl     | http://localhost:8888/hokuto-bs/news/ |

| option_name | option_value                          |
| ----------- | ------------------------------------- |
| home        | http://localhost:8888/hokuto-bs/news/ |

`wp-config` の記述は以下のとおりです。

### wp-config.php

```php
define('DB_NAME', 'hokuto-bs-db');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'root');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'root');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost:8889');

/** データベースのテーブルを作成する際のデータベースのキャラクターセット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/** WPを認識させる */
define('WP_HOME', 'http://localhost:8888/hokuto-bs');
define('WP_SITEURL', 'http://localhost:8888/hokuto-bs');

/** マルチサイト用追加設定 */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost:8888'); // ここにポート番号を追加
define('PATH_CURRENT_SITE', '/hokuto-bs/'); // サブディレクトリが正しいか確認
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
```

### .htaccess

```php
# BEGIN WordPress
RewriteEngine On
RewriteBase /hokuto-bs/

# これで book と news の wp-admin へのアクセスを許可
RewriteCond %{REQUEST_URI} ^/hokuto-bs/(book|news)/wp-admin/ [NC]
RewriteRule ^ - [L]

# リクエストされたファイルが
# 「存在するファイル」または「存在するディレクトリ」
# である場合に、次のルールに進むための条件。
# これにより、実在するファイルやディレクトリには、
# リライトを適用しないという意図があることが多いです。
RewriteCond %{REQUEST_FILENAME} -f [OR]
RewriteCond %{REQUEST_FILENAME} -d

# ^: すべてのリクエストに対して適用。
# -: 「書き換えを行わない」
# [L]: 該当するURLのリライト処理はここで終了。
RewriteRule ^ - [L]
RewriteRule ^(.*\.php)$ /hokuto-bs/$1 [L]
RewriteRule . index.php [L]
# END WordPress
```
---

以上、まずはどのようなご対応を頂けますかメールでのご連絡をお待ちいたします。

北斗プリント社　髙廣信之
takahiro@hokuto-p.co.jp