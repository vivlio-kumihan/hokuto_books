<?php /* Template Name: transaction */ ?>

<?php get_header(); ?>

<div id="page-top" class="main transaction">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3 class="main__header3">特定商取引法に基づく表記</h3>
        <dl class="infomation-chart">
          <div>
            <dt>販売業者名</dt>
            <dd>株式会社 北斗プリント社 </dd>
          </div>
          <div>
            <dt>代表取締役</dt>
            <dd>西川&emsp;大祐</dd>
          </div>
          <div>
            <dt>所在地</dt>
            <dd>〒606-8540 京都市左京区下鴨高木町38-2</dd>
          </div>
          <div>
            <dt>TEL</dt>
            <dd>075-791-6125</dd>
          </div>
          <div>
            <dt>FAX</dt>
            <dd>075-791-7290</dd>
          </div>
          <div>
            <dt>代金のお支払方法 </dt>
            <dd>銀行振込による前払い<br />振込確認を受けて、ご注文受付とさせていただきます。振込の際の手数料はお客様のご負担でお願いいたします。商品到着後７営業日以内にご指定先へ発送します。</dd>
          </div>
          <div>
            <dt>申込の有効期限</dt>
            <dd>７日間</dd>
          </div>
          <div>
            <dt>商品代金以外の費用</dt>
            <dd>消費税及び発送手数料は定価に含まれます。</dd>
          </div>
          <div>
            <dt>不良品</dt>
            <dd>確認時点でご連絡を頂いて､良品と交換いたします。</dd>
          </div>
          <div>
            <dt>不良品交換返金送料</dt>
            <dd>弊社負担</dd>
          </div>
          <div>
            <dt>引き渡し時期</dt>
            <dd>在庫のある場合はご発注確認後３日以内に発送、無い場合はご連絡申し上げます。</dd>
          </div>
          <div>
            <dt>返品期限<br />
              お客様の都合による返品</dt>
            <dd>納品より８日以内 （但し未開封に限る）</dd>
          </div>
          <div>
            <dt>返品送料<br />
              お客様の都合による返品</dt>
            <dd>往復送料・手数料お客様負担 </dd>
          </div>
        </dl>
      </div>
    </div>

    <aside class="main__other-info">
      <?php
      // データをテンプレートファイルに渡して表示
      load_template(get_template_directory() . '/components/other-info.php', false);
      ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>