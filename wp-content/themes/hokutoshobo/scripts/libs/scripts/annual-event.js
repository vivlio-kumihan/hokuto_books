"use strict";

class AnnualEvent {
  constructor(setSetsubunIns) {  
    this.currentYear = new Date().getFullYear();
    this.nowDate = new Date();
    // for test
    // this.currentYear = 2024;
    // this.nowDate = new Date(2024, 9 , 1);
    this.setSetsubunIns = setSetsubunIns;
    this.events = [
      { year: this.currentYear, month: 0, agendaDay: [1],
        eventID: "event-date-0101",
        title: "巻藁射礼",
        catch: "弓道の神髄に触れる",
        description: "秘仏の本尊御開帳あり。巻藁射礼（まきわらしゃれい）は、弓道の鍛錬と儀礼の一環として行われる儀式です。巻藁は、鍛錬用の藁束で作られた的のことを指します。この儀式は、弓道における八つの基本動作（足踏み、胴作り、弓構え、打起し、引分け、会、離れ、残心）の精緻な動作を通して、射手の技術と精神の統一を追求します​。その歴史は戦国時代や江戸時代に遡り、戦国時代は戦闘技術として発展し、江戸時代には精神修養と美的表現を重視する武道として進化しました​​。",
        image: "./images/event_makiwara_0_81D0409@0.5x.jpg",
        topImage: "./images/event_makiwara_0_81D0409@0.5x.jpg"
      },
      { year: this.currentYear, month: 0, agendaDay: [2],
        eventID: "event-date-0102",
        title: "釿初め",
        catch: "匠の安全を祈る",
        description: "番匠（ばんしょう）と呼ばれる御所出入りの宮大工たちが、正月に一年の安全を祈願する儀式です。京都市の無形民俗文化財に指定されている京木遣（きやり）音頭が流れるなか、古式の衣裳を身にまとった番匠保存会の会員によって厳粛に執り行われます。江戸時代には、「聚楽」「川東」「六条」「城下」などの大工組が、それぞれ特色ある木遣音頭を伝えていましたが、現在では二条城界隈の「城下」地域の大工衆を中心とした番匠保存会が、その保存と継承に努めています。2020年までは広隆寺で行われていましたが、2022年からは千本釈迦堂で釿始めが行われています。",
        image: "./images/event_chouna-hajime@0.25x.jpg",
        topImage: "./images/event_chouna-hajime.jpg",
      },
      { year: this.currentYear, month: 1, agendaDay: [this._setStsubunDay()],
        eventID: "event-date-0202",
        title: "おかめ福節分会",
        catch: "厄除け鬼追いと福豆まきの伝統行事",
        description: "秘仏の本尊御開帳あり。当山本堂建立について内助の功のあった棟梁、長井飛騨守高次の妻「阿亀（おかめ）」にちなむもので、当山境内にのこる「おかめ塚」と共に800年前より当寺に伝承されてきたものです。江戸時代末期に途絶えましたが、昭和26年（1951）からの本堂解体修理、昭和30年（1955）完成を記念して復活し今日に至ります。当日、本堂では年男と年女ともにおかめの面をつけ袈裟をかけます。おかめの清らかな心を敬いつつ福徳円満、御多福招来等の加持祈祷を行い、1年間の厄除けをするのが古くからのならわしとなっています。節分法要のあとに、古式厄除鬼追いの儀と続き、最後は一斉に福豆まきがおこなわれます。また、法要に先だって木遣音頭の奉納が行われます。",
        image: "./images/event_setsubune@0.25x.jpg",
        topImage: "./images/event_setsubune.jpg"
      },
      { year: this.currentYear, month: 2, agendaDay: [22],
        eventID: "event-date-0322",
        title: "千本の釈迦念仏",
        catch: "一語一語に込められた祈りを共に",
        description: "当山第二世如輪上人によってはじめられ（如輪入寂、文永8年［1271］）約750年前から当山に伝えられてきた法要で、お釈迦様の涅槃の日（旧暦2月15日）に釈迦の最後の遺教経をわかり易く一語一語訓読みにて大原声明千本式によって律（ふし）づけで奉詠（お唱え）するところから名付けられたものです。お経の終わりに「南無釈迦牟尼仏」と本尊お釈迦様の名号を初重、二重、三重の古律によって唱えられる念佛です。この行事は、兼好法師の『徒然草』にも記され、当時は多くの女官の参詣（聴聞）の様子がうかがわれます。毎年お釈迦様の遺徳をしのんで非常にありがたい、独特のお念仏でもあり、多くの信徒の参詣があります。",
        image: "./images/event_shaka-nembutsu@0.25x.jpg",
        topImage: "./images/event_shaka-nembutsu.jpg" 
      },
      { year: this.currentYear, month: 4, agendaDay: [8],
        eventID: "event-date-0508",
        title: "釈尊花祭",
        catch: "甘茶をかけてお釈迦様の誕生祝い",
        description: "正式名称は灌仏会（かんぶつえ）と呼ぶこのお祭りは、お釈迦様の誕生をお祝いし「子どもの身体健全・所願成就」を祈る仏教行事です。当寺では毎年5月8日に、花御堂と呼ばれる誕生仏（釈迦像）を囲った小さなお堂を安置して、参拝の方々には誕生仏に甘茶をかけてお祝していただきます。",
        image: "./images/event_hana-matsuri_0_81D0362@0.5x.jpg",
        topImage: "./images/event_hana-matsuri_0_81D0362@0.5x.jpg"
      },
      { year: this.currentYear, month: 6, agendaDay: [9, 10, 11, 12],
        eventID: "event-date-0709",
        title: "陶器供養会と陶器市",
        catch: "陶器に日ごろの感謝をこめる",
        description: "当山、本尊釈迦如来の方便化身とする地天尊を勧請し、日常生活に欠くことの出来ない瀬戸物の類を祀り感謝の誠を捧げ、家内安全・健康増進を祈り、併せて陶器業界発展のための祈願法要をおこないます。期間中は日没頃まで境内一帯で陶器市が開催され、境内に各地からの陶器が並んで終日にぎわいます。10日には本堂で陶器への感謝と業界の発展を祈る法要をおこないます。",
        image: "./images/event_touki-iti@0.25x.jpg",
        topImage: "./images/event_touki-iti"
      },
      { year: this.currentYear, month: 7, agendaDay: [8, 9, 10, 11, 12, 13, 14, 15, 16],
        eventID: "event-date-0808",
        title: "六道参り精霊むかえ",
        catch: "全国唯一、全六道の生命や存在の受容と救済",
        description: "秘仏の本尊御開帳あり。当山に安置されている六観音菩薩像は、六道信仰にもとづいて造立された聖観音、千手観音、馬頭観音、十一面観音、准胝観音、如意輪観音の六軀が完存し、まつられているのは当寺のみです。生命の転生の六つの世界である六道（地獄道、餓鬼道、畜生道、修羅道、人間道、天道）において、仏の智慧や力のあらわれである観音様により、迷えるご先祖・縁者のすべての精霊をお迎えして供養を施し、御仏の救いの力を功徳によってその滅罪追福を祈る行事です。精霊迎えは8月8～12日、精霊送り8月16日で執り行います。尚、期間中（8日〜16日）本尊釈迦如来像（秘仏）も御開帳となります。",
        image: "./images/event_rokudou-mairi@0.25x.jpg",
        topImage: "./images/event_rokudou-mairi.jpg"
      },
      { year: this.currentYear, month: 11, agendaDay: [7, 8],
        eventID: "event-date-1207",
        title: "成道会と大根だき",
        catch: "無病息災を願い、あつあつの大根をいただく",
        description: "秘仏の本尊御開帳あり。当山第三世慈禅上人によってはじめられ、当時はお釈迦様「さとりの日」を慶讃して盛大、かつ荘厳な「成道会」が営まれていました。お釈迦様は修行中、悪魔、諸鬼神、羅刹等の妨害と悪魔の誘惑にも屈せず、12月8日暁天の明星出現と同時に「おさとり」になられたことにあやかるため、上人は法要の際に大根へ釈迦の種子（梵字）を書き大壇の上にお供えして、「悪魔除け」としました。この大根を他の大根とともに炊き上げ、参詣者に供養されたのが「大根だき」のはじめといわれています。この行事は弘法大師により伝えられる加持法による祈祷会とともに、江戸末期頃まで代々続けられました。その後再び信徒のあつい信心によって復活し、今日では「中風、諸病除け、健康増進」の祈祷法要を厳修し、大根を煮込んで7日、8日の両日参詣者に授与しております。",
        image: "./images/event_daikon-daki@0.25x.jpg",
        topImage: "./images/event_daikon-daki_slide.jpg"
      },
    ];
    this.wrapperedImage = document.querySelector("#annual-events-top-image");
    this._init();
  }

  _init() {
    this._updateEventDates();
    this.allEvents();
    this.select4Events();
  };

  _updateEventDates() {
    const weekDays = ["日", "月", "火", "水", "木", "金", "土"];
    const yearsOfSetsubun = [2025, 2029, 2033, 2037, 2041, 2045];
    for (const event of this.events) {
      // 現在の段階で、まだ執行していない行事の日付を格納する。
      const futureDays = event.agendaDay.filter(day => new Date(event.year, event.month, day) > this.nowDate);
      // 現在の日付が、行事の『期間中』である場合の処理。
      if (event.month === this.nowDate.getMonth() && event.agendaDay.includes(this.nowDate.getDate())) {
        let getIndex = event.agendaDay.indexOf(this.nowDate.getDate());
        // 現在の日付から見て、期間中の日付の中から翌日の日付を格納する。
        // 1日だけの場合はインデックス0番目を格納する。
        event.currentDay = getIndex < event.agendaDay.length
          ? [event.agendaDay[getIndex]]
          : [event.agendaDay[0]];
      // 現在の日付が、行事の『期間前後』である場合の処理。                                  
      } else {
        event.currentDay = futureDays.length > 0
          ? [futureDays[0]]
          : [event.agendaDay[0]];
        if (yearsOfSetsubun.includes(this.currentYear + 1) && event.title === "おかめ福節分会") {
          event.currentDay = [2];
        } else if (event.title === "おかめ福節分会") {
          event.currentDay = [3];
        }
        // 期日を過ぎたイベントの年度を1年後に設定。
        if (futureDays.length === 0) event.year += 1;
      } 
      // 曜日の算出
      event.weekDayStart = weekDays[new Date(event.year, event.month, event.currentDay[0]).getDay()];
      event.weekDayEnd = weekDays[new Date(event.year, event.month, event.agendaDay.slice(-1)[0]).getDay()];
      // 日付の算出
      if (event.agendaDay.length > 1) {
        event.date = `${ event.year }年${ event.month + 1 }月${ event.agendaDay[0] }日(${ event.weekDayStart })〜${ event.agendaDay.slice(-1)[0] }日(${ event.weekDayEnd })`
      } else {
        event.date = `${ event.year }年${ event.month + 1 }月${ event.currentDay[0] }日(${ event.weekDayStart })`
      }
    }
  };

  allEvents() {  
    const sortedEvents = this.events.sort((a, b) => {
      // 月で比較
      if (a.month !== b.month) {
        return a.month - b.month;
      }
      // 月が同じなら日で比較
      return a.agendaDay[0] - b.agendaDay[0];
    });    
    this.selectEvents = sortedEvents;
    this._renderAllEvents();
    this._renderTopImage()
  };
  
  select4Events() {
    // this.events の深いコピーを作成
    const eventsCopy = this.events.map(event => ({ ...event }));

    // 課題
    // 新しいイベントをコピーに追加
    const addEvent = { 
      year: 2024, month: 9, agendaDay: [9],
      date: "2024年10月9日（金）",
      title: "この記事はサンプルです。リロードのテスト",
      catch: "この記事はサンプルです。リロードのテスト。リロードのテスト。",
      description: "リロードのテスト。リロードのテスト。リロードのテスト。リロードのテスト。リロードのテスト。リロードのテスト。",
      image: "./images/img_topPage_info_image.jpg",
      link: "https://apple.com"
    };
    eventsCopy.push(addEvent);
    // 日付が一番若いイベントから4つを選んで配列に格納
    if (Array.isArray(eventsCopy)) {
      const sortedEvents = eventsCopy.sort((a, b) => {
      // const sortedEvents = this.events.sort((a, b) => {
        const dateA = new Date(a.year, a.month, a.agendaDay[0]);
        const dateB = new Date(b.year, b.month, b.agendaDay[0]);
        return dateA - dateB;
      });
      this.selectEvents = sortedEvents.slice(0, 4);
      this._renderSelect4Events();
    } else {
      console.error("エラーだ。");
    }
    // 課題__end
  };

  _renderTopImage() {   
    // this.events の深いコピーを作成
    const eventsCopy = this.events.map(event => ({ ...event }));

    // 日付が一番若いイベントから4つを選んで配列に格納
    if (Array.isArray(eventsCopy)) {
      const sortedEvents = this.events.sort((a, b) => {
        const dateA = new Date(a.year, a.month, a.agendaDay[0]);
        const dateB = new Date(b.year, b.month, b.agendaDay[0]);
        return dateA - dateB;
      });
      if (this.wrapperedImage === null) return;
      this.wrapperedImage.src = sortedEvents[0].topImage;
    } else {
      console.error("error");
    }
  }

  _renderAllEvents() {
    const eventList = document.querySelector(".event-schedule__all");
    if (!eventList) {
      return; // イベントリストが見つからない場合は処理を終了
    }
    eventList.innerHTML = "";
    this.selectEvents.forEach(event => {
      const listItem = document.createElement("li");
      listItem.classList.add("rule-line");
      listItem.innerHTML = `
        <div class="event-schedule__wrapper">
          <div class="event-schedule__date">${ event.date }</div>
          <div class="event-schedule__title">${ event.title }</div>
          <div class="event-schedule__image cover-slide hover-darken">
            <div class="bg-img-zoom img-bg50 ${ event.eventID }"></div>
          </div>
          <div class="event-schedule__catch">${ event.catch }</div>
          <div class="event-schedule__description">${ event.description }</div>      
        </div>
        <div class="chapter__btn to-modal">
          <button href="" class="btn slide-bg" data-name="${ event.eventID }">写真を見る→</button>
        </div>
        <span class="line-effect top"></span>
        <span class="line-effect right"></span>
        <span class="line-effect bottom"></span>
        <span class="line-effect left"></span>
      `;
      eventList.appendChild(listItem);
    })
  };

  _renderSelect4Events() {
    const eventList = document.querySelector(".event-schedule__latest4");
    if (!eventList) return; // イベントリストが見つからない場合は処理を終了
    
    eventList.innerHTML = "";
    this.selectEvents.forEach(event => {
      const listItem = document.createElement("li");
      listItem.classList.add("rule-line", "item");
      const truncatedDescription = event.description.length > 50 
        ? event.description.substring(0, 50) + '...' 
        : event.description;

      let infoLink = "";
      if (event.link) {
        infoLink = document.createElement("a");
        infoLink.classList.add("event-schedule__info-link", "noto-sans-jp", "active");
        infoLink.href = event.link;
        infoLink.target = "_blank";
        infoLink.textContent = "情報元へのリンク";
        infoLink = infoLink.outerHTML;
      }

      listItem.innerHTML = `
        <div class="event-schedule__image"><img class="item" src="${ event.image }"></div>
        <div class="event-schedule__wrapper item">
          <div class="event-schedule__date">${ event.date }</div>
          <div class="event-schedule__title">${ event.title }</div>
          <div class="event-schedule__catch">${ event.catch }</div>
          <div class="event-schedule__description">${ truncatedDescription }${ infoLink }</div>      
        </div>
      `;
      eventList.appendChild(listItem);
    })
  };

  _setStsubunDay() {
    for (const setsubun of this.setSetsubunIns.yearsObj) {
      if (setsubun.year === this.currentYear) {
        return setsubun.day;
      }
    }
  };  
}
