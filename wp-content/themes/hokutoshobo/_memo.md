# WPダッシュボードの接続設定
* URL: http://www.hokutoshobo.jp/wp-admin/
* ID: jhshktsb2016
* PW: TKsL%yDj%7i977TGZO5n&OwI

# fontawsome

```scss
.tel-number {
  position: relative;
  font-size: 25px;
  font-weight: 900;
  font-family: $fontGothic;
  &::before {
    position: absolute;
    top: 50%;
    transform: translateY(-30%);
    left: -25px;
    content: "\f095";
    font-size: 20px;
    font-family: "Font Awesome 6 Free";
    font-weight: bold;
  }
}
```

# 文章を詰める

```
font-feature-settings: "palt" 1;
```

```html
<a href="<?php echo esc_url(home_url('/contact')); ?>">お問い合わせ</a>
```

```html
<img src="<?php echo get_template_directory_uri(); ?>/images/bnr-jsjapan.png" />
```

# 一文字落とす

```
text-indent: 1em;
```