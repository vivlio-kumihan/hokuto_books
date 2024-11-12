class HeroSlider {
  constructor(el) {
    this.el = el;
    this.swiper = this._initSwiper();
  }  
  _initSwiper() {
    return new Swiper(this.el, {
      effect: 'coverflow',
      loop: true,
      speed: 1500,
      slidesPerView: 1,
      breakpoints: {
        960: {
          slidesPerView: 1.6,
        },
        1480: {
          slidesPerView: 1.7,
        }
      }, 
      centeredSlides: true,
    });
  }

  // 引数にオブジェクトを代入することで
  // パラメータの書き換えができるように改造
  autoStart(options = {}) {
    options = Object.assign({
      delay: 8000
    }, options);
    this.swiper.params.autoplay = options;
    // start()関数は組み込み。
    this.swiper.autoplay.start();
  }
  autoStop() {
    this.swiper.autoplay.stop();
  }
}
