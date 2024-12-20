class FadeSlider {
  constructor(el) {
    this.el = el;
    this.swiper = this._initSwiper();
    // console.log("Swiper instance:", this.swiper); // インスタンス確認
  }

  _initSwiper() {
    return new Swiper(this.el, {
      effect: 'fade',
      loop: true,
      fadeEffect: {
        crossFade: true
      },
      speed: 1000,
      slidesPerView: 1,
      centeredSlides: true,
      // navigation: {
      //   nextEl: '.swiper-button-next',
      //   prevEl: '.swiper-button-prev',
      // },
    });
  }

  autoStart(options = {}) {
    options = Object.assign({
      delay: 4000
    }, options);
    this.swiper.params.autoplay = options;
    this.swiper.autoplay.start();
  }

  autoStop() {
    this.swiper.autoplay.stop();
  }
}