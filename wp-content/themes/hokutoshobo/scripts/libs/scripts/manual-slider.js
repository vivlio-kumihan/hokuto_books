class ManualSlider {
  constructor(el) {
    this.el = el;
    this.activeIndex = 0;
    this.slides = [];
    this.swiper = this._initSwiper();
    this.slides = this.swiper.slides;
    // リロードされた状態での初期設定のインデックス。つまり最初のスライドが表示される状態ということ。
    this.previousOnClickSlideIndex = null;
    // [previousOnClickSlideGroup, activeGroup, activeSlide, nextSlide]のこと。
    this.slideState = [null, null, null, null];
    this.descriptions = {
      buddhistStatue: [
        {
          groupName: "本尊釈迦如来坐像",
          title: "本尊 釈迦如来坐像",
          importantCulturalProp: "重要文化財",
          specification: [
            { entry: "素材", value: "木造、金泥塗り、漆箔" },
            { entry: "像高", value: "89.3センチ" },
            { entry: "時代", value: "鎌倉・13世紀" }
          ],
          note: [
            "右手施無畏、左手与願の印を結び、像高89.3センチ、寄木内刳り、玉眼。肉身は後世の塗り直しであろう粉溜塗り、衲衣は漆箔となっています。",
            "光背は、舟形の透彫唐草光で当初のもの。台坐は八角七重の蓮華座ですが、上半部は後補とみられています。なお、本尊の頭上にかかる天蓋も創建当時のもので、八葉蓮華文を中にして、唐草文を浮彫りにした八方の吹き返しをめぐらし、周囲に華麗な瓔珞を垂らしています。",
            "作者は、行快。快慶の弟子で、長谷寺本尊の造立に師匠をよくたすけて活躍した仏師です。",
            "像の胎内背部下方に、作者名『巧匠　法眼行快』と師匠快慶が好んで署名したものを真似たような朱書きが残っています。作風は、快慶より受け継いだ理智的な鋭さをみせている反面、師匠のような繊細味はみられず、むしろ太作りで写実風が強くなっています。"
          ],
        }, 
        {
          groupName: "十大弟子立像",
          title: "十大弟子立像",
          importantCulturalProp: "重要文化財",
          specification: [
            { entry: "素材", value: "木造、截金、玉眼" },
            { entry: "像高", value: ["94.8センチ（舎利弗尊者）", "97.2センチ（目犍連尊者）", "98.0センチ（大迦葉尊者）", "94.0センチ（須菩提尊者）", "96.4センチ（富楼那尊者）", "99.8センチ（迦旃延尊者）", "96.7センチ（阿那尊者律）", "96.0センチ（優波離尊者）", "97.9センチ（羅睺羅尊者）", "97.0センチ（阿難陀尊者）"] },
            { entry: "時代", value: "鎌倉・13世紀" }
          ],
          note: [
            "十大弟子とは、釈迦の弟子のなかでも特に優れた十人のことを指します。仏教彫刻・絵画のモチーフになることも少なくありません。創建当時、彫刻は、須弥壇上の釈迦に随侍するかたちで置かれていたと考えられ現在も十軀を完備して伝えています。",
            "目犍連尊者と優波離尊者の両尊者像に快慶の署名があり、作者を明らかにすることができます。快慶は運慶とならんで高名な鎌倉初期の大仏師で、この像にも綺麗好みの作者の特色がよく出ています。",
            "本像は、切金の彩色もよく残っており、当初の華やかさが察せられる肖像尊像の代表です。",
            "十軀の像は、作風的に2つの制作グループに分けられていたようで、一つは、快慶一門の手になると思われる目犍連、阿那律・富楼那・優波離・羅睺羅・阿難陀の六軀。そして、運慶系統の作風を示す、舎利弗・大迦葉・須菩提・迦旃延の四軀です。",
            "快慶一門を中心に、それとは別系統の仏師が参入した混成チームで制作にあたったと思われています。"
          ], 
        }, 
        {
          groupName: "六観音菩薩像",
          title: "六観音菩薩像",
          importantCulturalProp: "国宝",
          specification: [
            { entry: "素材", value: "木造、素地、玉眼" },
            { entry: "像高", value: ["178.0センチ（聖観音）", "179.5センチ（千手観音）", "175.2センチ（馬頭観音）", "181.6センチ（十一面観音）", "175.6センチ（准胝観音）", "96.5センチ（如意輪観音）"] },
            { entry: "時代", value: "鎌倉・貞応3年（1224）" }
          ],
          note: [
            "六観音とは、真言宗では聖・千手・馬頭・十一面・准胝・如意輪の6つをとりあげ、天台宗では准胝のかわりに不空羂索を加えます。それぞれ地獄・餓鬼・畜生・修羅・人・天の六道を救う観音とされています。",
            "この六観音像は、六道信仰とともに各地で造仏されましたが、六体が完全な形で祀られているのは、当寺のみで非常に貴重な尊像です。",
            "なお、六道思想による六道信仰は、藤原時代に盛んになり、現在京都では「「六道まいり」の名で親しまれています。",
            "六軀の中でも抜群の出来映えを示すしているのが定慶作の准胝観音像です。",
            "定慶は、師匠運慶作の菩薩像を規範としながら、面部の各要素の配置や衣文表現などが定慶らしい個性的な表現を生み出しました。師匠と同じく古代の彫刻や同時代の中国作品に学びながら、その要素を巧みに取り入れたことで知られる仏師です。",
            "それ以外の五軀には銘記はありませんが、六観音菩薩蔵制作については、定慶が全体の統率者として、定慶・快慶門下やその他慶派の仏師が集結して造像にあたったと考えられています。",
            "なお、六観音の胎内に納められていた経巻が8巻も発見されており、それによれば藤原以久の娘が願主となって造像したことが分かっています。"
          ], 
        }, 
        {
          groupName: "地蔵菩薩像",
          title: "地蔵菩薩像",
          importantCulturalProp: "国宝",
          specification: [
            { entry: "素材", value: "木造、彩色、玉眼" },
            { entry: "像高", value: "164.5センチ" },
            { entry: "時代", value: "鎌倉・13世紀" }
          ],
          note: [
            "定慶作の准胝観音像とよく似ており、とりわけ面貌表現は、耳のかたちを含めて酷似した特徴を持っています。また、この時代にはめずらしく一本造（いちぼくづくり）であることも六観音菩薩像と共通しており、両者がセットのものとして造られたと可能性が高いと考えられています。"
          ], 
        },
        {
          groupName: "千手観音菩薩像",
          title: "千手観音菩薩像",
          importantCulturalProp: "重要文化財",
          specification: [
            { entry: "素材", value: "木造、彩色" },
            { entry: "像高", value: "165.9センチ" },
            { entry: "時代", value: "平安時代・10世紀" } 
          ],
          note: [
            "当寺、創立以前の古像で伝来は明らかではありません。岩座の上に立ち、像高176.2センチの一木造り、彩色は剥落しています。頭上の化仏はほとんど古く、千手の中には補作も多くあります。肉付きはかなり平調でありながら穏やかな感じをたたえ、ことに衣文は飜波が形式的に整えられて、よく藤原前期彫刻の特徴を表しています。"
          ], 
        }
      ],
      kyooudou: [
        {
          groupName: "経王堂",
          title: "経王堂",
          importantCulturalProp: "",
          specification: [],
          note: [
            "北野経王堂は足利義満によって建てられた仏堂で、大報恩寺のほど近く、北野天満宮大鳥居の南にありました。",
            "明徳の乱、内野合戦後、戦没者を弔うため畿内の五山僧1,100人を集め戦場となった内野で法華経一万部を読誦する法会（万部経会）が行われました。応永8年（1401）義満により万部経会を恒常的におこなう大堂宇の建立が発願され経王堂が完成します。その規模は、長さ30間（59m）、横25間（49m）と東大寺大仏殿に匹敵し、当時としては洛中、洛外を含む京都市中最大級の巨大建造物と伝わっています。",
            "経王堂で行われた北野万部経会は、歴代の室町将軍が主導する年中行事として定着し、応仁の乱（1467〜1477）以前はほぼ毎年行われていたようで、貴賤を問わず多くの聴聞衆でたいへん賑わっていたことが公家日記などで伝わっています。"
          ], 
        }, 
        {
          groupName: "傳大士坐像と二童子立像",
          title: "傳大士坐像と二童子立像",
          importantCulturalProp: "",
          specification: [
            { entry: "素材", value: "木造、彩色、玉眼" },
            { entry: "像高", value: ["70.1センチ（傳大士）", "72.9センチ（普建）", "73.0センチ（普成）"] },
            { entry: "時代", value: "室町・応永35年（1418）" }
          ],
          note: [
            "傳大士（ふだいし）（傳翕［ふきゅう］）を中に左童子（普建［ふけん］）と右童子（普成［ふじょう］）を従える3体。傳大士は中国南朝の僧で、輪蔵の制を創設したことによりその前に傳大士と二童子像が置かれるようになったといいます。",
            "経王堂内の輪蔵に一切経とともに安置されたのがこの三尊像です。",
            "木造、寄木造、サビ漆地黒漆塗り彩色、玉眼嵌入。",
            "傳大士は頭・体別材。頭部は両耳後ろの位置で前後に二材を矧ぎ、内刳り。首枘を作り体部に接合。体部は前後二材の間に板材各一枚を挟み、上部に肩を形成する各一材を当てて、全体で箱形構造とする。像内大部腰辺で前後材をつなぐ桟を、また前面材下方に像心束をつくり出します。左袖上部に1材、右袖部に一材を各矧ぐ。両足部は大部との間に板材を挟んで横一材を、着衣垂下部は横一材を各矧ぐ。肉身部肉色、着衣部は彩色および切金による各種の文様が配されます。",
            "いっぽう、二童子像は基本的には頭体の主要根幹部（足枘をふくむ）を一材で取り、周囲に数材を取り付けるように矧ぐという特殊な木寄せです。仕上げは、肉身部肉色、着衣部は彩色による各種の文様が配され、一部に金泥の盛上げ彩色があります。",
            "傳大士像は、箱を重ねたような角のある体格、大きくうねる衣文のある作り、木寄せ構造から、室町時代の院派仏師の作と見られます。"            
          ], 
        }, 
        {
          groupName: "扁額",
          title: "扁額",
          importantCulturalProp: "",
          specification: [
            { entry: "素材", value: "木造、彩色" },
            { entry: "縦", value: "138.5センチ" },
            { entry: "横", value: "93.8センチ" },
            { entry: "時代", value: "室町・応永32年（1425）" }
          ],
          note: [
            "経王堂に掲げられていたという扁額。『洛北千本大報恩寺縁起（上付き 并由致拾遣）』の「経王堂」の項に「義満公自書経王堂ノ三大字」とあり、『義済准后日記』応永32年（1425）10月5日条に、「今日経堂額被打之、経王堂云々、御筆云々」とあるのに相当します。義満自筆と伝えられるが義政筆との説もあります。左下に「大樹蔭涼」の印刻方印があります。",
            "針葉樹材、本体部は左右二材矧ぎ、地は黒漆塗り地に漆箔。二重に枠木をまわし（外側の分は漆箔、間は緑青）、周縁部には四方各一材を当て、朱と緑青の雲文を描いています（裏は黒漆塗り）。"            
          ], 
        }, 
        {
          groupName: "鼉太鼓縁 二基",
          title: "鼉太鼓縁 二基",
          importantCulturalProp: "重要文化財",
          specification: [
            { entry: "素材", value: "木造、彩色、漆箔" },
            { entry: "高", value: "358.0センチ" },
            { entry: "時代", value: "室町" }
          ],
          note: [
            "龍と鳳凰を大きくあしらう鼉太鼓（だだいこ）の縁。足利義満公以来、室町幕府が施主となって毎年修された北野経会に舞楽奉納時に使用されたものです。",
            "昭和54年度に修理され面目を一新しました。頂に日像・月像（新補）を掲げ、太鼓の縁は雲文を主体とし周縁部は火焔、その上方に三面宝珠（新補）、左右に龍（一対）あるいは鳳凰（一対）を配しています。",
            "針葉樹材、正中で左右二材を矧ぎ、下方の枘までを共木でつくり、細部に小材を寄せています。宝珠および龍・鳳凰は各別材製。布張り、サビ下地、雲文は彩色、日像・月蔵、火焔、宝珠は漆箔、龍・鳳凰は漆箔に一部彩色。",
            "経王堂伝来で、応永8年（1401）創建期のものとされています。"            
          ], 
        }, 
        {
          groupName: "北野経王堂一切経",
          title: "北野経王堂一切経",
          importantCulturalProp: "重要文化財",
          specification: [
            { entry: "素材", value: "紙本墨書" },
            { entry: "縦", value: "25.6センチ前後" },
            { entry: "横", value: "12.8センチ前後" },
            { entry: "時代", value: "室町・応永19年（1412）" }
          ],
          note: [
            "経王堂内の輪蔵に傳大士坐像と二童子立像とともに安置されたのがこの一切経です。",
            "一切経とは、経・律・論の三蔵に加えて中国の高僧が著した撰述書などを加えた仏典の集大成。",
            "この一切経は、応永19年（1412）に北野経王堂の覚蔵坊増範なる僧が北野天満天神法楽のために発願し、同年3月17日より8月18日までの5ヶ月という非常に短い期間に、東は越後・尾張、西は九州肥前・薩摩などの諸国の僧俗200余人の合力を得て勧進書写したものです。完成した一切経は、翌応永20年（1413）に建立された輪蔵に納められました。謡曲「輪蔵」はこの一切経と輪蔵を謡ったものとして知られています。",
            "現在、その数は、補写も含めて5048帖が伝えられています。",
            "装訂は、縦25.6センチ、横12.8センチ前後の折本装で、半面7行（1折14行）となっていますが、元は巻子本であったと見られています。"            
          ], 
        }
      ],
      architectural: [
        {
          groupName: "本堂",
          title: "本堂",
          importantCulturalProp: "国宝",
          specification: [],
          note: [
            "本尊が安置される本堂は、義空が天台宗の教義を大報恩寺に反映したことを強く示している構造になっています。",
            "四天柱（してんはしら）をもつ求心的な一間四面堂（いっけんしめんどう）という平面形式をとっており、これは、天台宗の常行堂や法華堂の系譜であり、仏像を安置する内陣に、人が仏を礼拝する場である礼堂（外陣）を併設する特徴的な空間です。",
            "開放的な礼堂と厳かな内陣とは、格子戸でゆるやかにつなげられています。",
            "そして、内陣中央の四天柱で取り込まれた須弥壇には、本尊を安置する厨子が置かれ、その後方には2本の四天柱にはさまれた壁画があり、表面・裏面とともに、本堂全体を貫く主題である「釈迦は永久にこの世に存在し法を説く」という釈迦霊鷲山（りょうじゅせん）説法にもとづく図容が描かれています。"
          ], 
        }, 
        {
          groupName: "本堂特徴",
          title: "本堂特徴",
          importantCulturalProp: "",
          specification: [],
          note: [
            "本堂外観の特徴は、入母屋造・檜皮葺、桁行五間、梁行六間の大規模な仏堂で、洛中最古の木造建築です。",
            "太く立ち上がりの低い丸柱、おだやかな反りをみせる檜皮葺の屋根、水平線を強調する長押（なげし）、蔀戸（しとみど）、妻戸（つまど）、舞良戸（まいらど）という建具からなるその外観は、宇治上神社拝殿（鎌倉時代後期・国宝）や東寺西院大師堂（南北朝時代後期・国宝）などとともに、中世京都の貴族住宅の雰囲気をもつ和様建築の代表とされています。"
          ], 
        }, 
        {
          groupName: "本堂内部特徴",
          title: "本堂内部特徴",
          importantCulturalProp: "",
          specification: [],
          note: [
            "本堂内部の空間構成は、礼堂・内陣・脇陣・後戸からなる典型的な中世の仏堂の空間構成をとり、内陣を中心として一間四面の求心堂の形状を置く特徴的なものです。"
          ], 
        }, 
        {
          groupName: "礼堂",
          title: "礼堂",
          importantCulturalProp: "",
          specification: [],
          note: [
            "礼堂では虹梁（こうりょう）をもちいて梁行（はりゆき）二間の大きな空間をつくりだしています。",
            "礼堂は、正面側の一間を垂木をみせる化粧屋根裏、後方一間を組入天井とし、内陣との境を吹寄菱欄間・格子戸で仕切っています。",
          ], 
        }, 
        {
          groupName: "内陣",
          title: "内陣",
          importantCulturalProp: "",
          specification: [],
          note: [
            "内陣は、中央にひときわ太い四天柱を立て、その周囲に梁行一間の庇をまわした、一間四面の求心的な構成をとっています。",
            "左右に配される脇陣、背後の後戸よりも床が一段高く構えられています。",
            "内陣中央の四天柱には極彩色で四天王像を描き、折上小組格天井を張り、須弥壇・仏後壁を設けています。",
            "四天柱周囲の庇部分は組入天井とし、三斗組で持ち出された天井周縁部には、七宝繫小天井と呼ばれる円を組み合わせた意匠をもちいています。"
          ], 
        }, 
        {
          groupName: "壁画",
          title: "壁画",
          importantCulturalProp: "",
          specification: [
            { entry: "素材", value: "板地、著色" },
            { entry: "各縦", value: "245センチ" },
            { entry: "各横", value: "410センチ" },
            { entry: "時代", value: "鎌倉" }
          ],
          note: [
            "壁画は須弥壇背面の来迎板壁の両面に描かれています。剥落が著しくかつ、背面のものは細密なものであり、また前面のものには大きい厨子が壁面に接して安置してあるため十分にうかがい難い状況ですが、いずれも鎌倉の絵画として注目すべきものを含んでいます。",
            "前面のものには中心の本尊はなく、前方に安置される彫刻の釈迦像を守るように、普賢、文殊、梵天、帝釈天、四天王、その他20体の諸尊像が描かれています。",
            "一方背面には、中央上部に釈迦を配し、その周辺に多くの菩薩、僧形俗形の人たち、また下方には2基の車を描き、その主題が釈迦霊鷲山（りょうじゅせん）説法図であることを示しています。これら壁画の制作年代は、現在の須弥壇が創建後2回改修されたものである点よりみて、安貞年間（1227〜1229）とは考え難く、約70年くだった正応年間（1288〜1293）頃に制作されたものと考えらています。絵の様式も、概ねこの時代に合っており、建築的考察ともよく適合しています。",
          ], 
        }
      ]
    };

    this._updateSlidesAndCurrentIndex();
    this._bindEvents();
    this._getPreGroupAndActiveNextSlideName();
    this._renderName();
    this._whichDescription()
    this._renderDescription();
  }
  
  _initSwiper() {
    return new Swiper(this.el, {
      effect: "fade",
      // スライダーに説明文をつけるメソッドとの関係でこの機能はrejectする。
      // loop: true,
      allowTouchMove: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  }

  _whichDescription() {
    const descriptionElms = document.querySelectorAll(".cultural-heritage-description");
    descriptionElms.forEach(el => {
      const selectDescription = el.getAttribute("data-description");
      this.description = this.descriptions[selectDescription];
    })
  }

  _bindEvents() {
    const browseList = document.querySelectorAll(".browse li");
    browseList.forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
        const targetName = link.getAttribute("data-name");
        this._goToSlide(targetName);
      });
    });
  }

  _goToSlide(targetName) {
    for (let idx = 0; idx < this.slides.length; idx++) {
      const slide = this.slides[idx];
      if (slide.getAttribute("data-anchor-name") === targetName) {
        // loop:trueの場合、slideToLoopを使用 => this.swiper.slideToLoop(idx); 
        this.swiper.slideTo(idx); // loop:falseの場合
        break;
      }
    } 
  }

  _updateSlidesAndCurrentIndex() {
    this.activeIndex = this.swiper.realIndex; // 現在のスライドのインデックス
    this.slides = this.swiper.slides;
    this.previousOnClickSlideIndex = this.previousOnClickSlideIndex || this.swiper.realIndex; // 初回のみnull
    this._getPreGroupAndActiveNextSlideName(this.description); // 初期状態でもスライド情報を取得
  }

  _getPreGroupAndActiveNextSlideName() {
    if (!this.isSlideChangeEventBound) {
      // ページがリロードされた初期状態で期待するインスタンスを設定しておく。
      const slides = this.swiper.slides;

      // 他のページで、
      // slides[activeIndex].dataset.anchorNameがundefinedになり
      // 表示ができなくなる問題を解決させる1行
      if (!slides || slides.length === 0) return;
      
      const previousOnClickSlideGroup = null;
      const activeIndex = this.swiper.realIndex;      
      const activeGroup = slides[activeIndex].dataset.group;

      // 上と同じく
      if (!activeGroup) return;

      const activeSlide = slides[activeIndex].dataset.anchorName; // 現在のスライド
      const nextSlide = slides[(activeIndex + 1) % slides.length].dataset.anchorName || null;
      this.slideState = [previousOnClickSlideGroup, activeGroup, activeSlide, nextSlide]; 

      this.swiper.on("slideChange", () => {
        const slides = this.swiper.slides;
        const previousOnClickSlideIndex = this.previousOnClickSlideIndex;
        const activeIndex = this.swiper.realIndex; // 現在のスライドのインデックス
  
        // スライドをループさせる場合には必須。
        // if (previousOnClickSlideIndex >= slides.length) {
        //   previousOnClickSlideIndex = 0;
        // }

        // 前回クリックしたグループ
        const previousOnClickSlideGroup = previousOnClickSlideIndex === null ? this.slides[0].dataset.group : this.slides[previousOnClickSlideIndex].dataset.group;
        const activeGroup = slides[activeIndex].dataset.group; // 現在のグループ
        const activeSlide = slides[activeIndex].dataset.anchorName; // 現在のスライド
        // (activeIndex + 1) % slides.length => インデックスをエンドレスに辿っていくために必要な処理です。
        // ただ、swiperの仕様の関係でループできませんが。。。
        const nextSlide = activeIndex + 1 !== slides.length
          ? slides[(activeIndex + 1) % slides.length].dataset.anchorName // 次のスライド
          : null;
        this.slideState = [previousOnClickSlideGroup, activeGroup, activeSlide, nextSlide];
        // previousOnClickSlideIndexを更新
        this.previousOnClickSlideIndex = this.swiper.realIndex;
        this._renderName();
        this._renderDescription(this.description);
      });
      this.isSlideChangeEventBound = true;
    }
  }

  _renderName() {
    const layoutedSpread = document.querySelector(".area4displaying-slide-name");
    if (!layoutedSpread || !this.slideState) return;

    const [, , activeSlide, nextSlide] = this.slideState;

    layoutedSpread.innerHTML = "";

    if (activeSlide) {
      const activeNameDiv = document.createElement("div");
      activeNameDiv.className = "area4displaying-slide-name__active-name";
      activeNameDiv.textContent = activeSlide;
      
      // 大変残念だが不採用にする。
      // const nextNameDiv = document.createElement("div");
      // nextNameDiv.className = "area4displaying-slide-name__next-name";
      // nextSlide !== null
      //   ? nextNameDiv.textContent = `次は、${ nextSlide }`
      //   : nextNameDiv.textContent = "";
      // layoutedSpread.appendChild(nextNameDiv);
      layoutedSpread.appendChild(activeNameDiv);
    }
  }

  _renderDescription() {
    const culturalHeritageDescription = document.querySelector(".cultural-heritage-description");
    if (!this.description || !this.slideState) return;

    const [, activeGroup] = this.slideState;
    const descriptionData = this.description.find(item => item.groupName === activeGroup);
    
    culturalHeritageDescription.innerHTML = "";

    if (descriptionData) {
      // console.log(descriptionData);
      const { title, importantCulturalProp, specification, note } = descriptionData;
      const arrToList = (arg) => {
        if (Array.isArray(arg)) {
          return arg.map(item => `<div>${item}</div>`).join("");
        } else {
          return arg;
        }
      };
      const list = specification.map(spec => `
        <li>
          <div class="cultural-heritage__description-entry">${ spec.entry }：</div>
          <div class="cultural-heritage__description-value">${ arrToList(spec.value) }</div>
        </li>
        `).join('');
      const paragraph = note.map(para => `<p>${para}</p>`).join("");

      const descriptionHTML = `
        <div class="cultural-heritage__description-wrapper">
          <h2 class="main-title cultural-heritage__description-header">${title}</h2>
          <div class="cultural-heritage__description-important-cultural-prop">${ importantCulturalProp }</div>
          <div class="cultural-heritage__description-spec-and-para">
            <ul class="cultural-heritage__description-specification">
              ${ list }
            </ul>
            <div class="cultural-heritage__description-paragraph">
              ${ paragraph }
            </div>
          </div>
        </div>
      `;
      culturalHeritageDescription.innerHTML = descriptionHTML;
    }




  }
}