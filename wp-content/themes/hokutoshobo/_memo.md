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

めも
    <div class="attention">
      <a class="arrow-link" href="http://www.hokuto-p.co.jp/factory/index.html" target="_blank">
        株式会社&nbsp;北斗プリント社&nbsp;工場見学<span class="mq-sm-apear">へ</span><span class="mq-lg-apear">（別ウィンドウで開きます）</span>
      </a>
    </div>