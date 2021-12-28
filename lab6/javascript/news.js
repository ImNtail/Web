newsdatadump =[]
newsdata =[];
myrow = document.getElementById('myrow');
modalcont = document.getElementById('modcont');
modal = document.getElementById("myModal");
searchbutton = document.getElementById("srhbtn");
currentpage = 1;

window.addEventListener("load", function(){
  LoadDataFromJson();
});

function LoadDataFromJson(){
  let requestURL = 'jsons/news.json';
  let request = new XMLHttpRequest();
  request.open('GET', requestURL);
  request.responseType = 'json';
  request.send();
  request.onload = function() {
    newsdata = request.response;
    newsdatadump = request.response;
    populateNews(currentpage);
    addEventsToPag();
  }
}

function populateNews(n) { 
  myrow.innerHTML = '';
  for (let i = 5*n-5; i < Math.min(newsdata.data.length, 5*n); i++) {

    newsdiv = document.createElement('div');
    newsdiv.classList.add("mydiv");

    myH1 = document.createElement('h1');
    myH1.textContent = newsdata.data[i].title;
    myH1.classList.add("newshead");
    newsdiv.appendChild(myH1);

    myImg = document.createElement('img');
    myImg.src = 'img/'+newsdata.data[i].image;
    myImg.classList.add("newsimg");
    newsdiv.appendChild(myImg);

    myPara = document.createElement('p');
    myPara.textContent = newsdata.data[i].shortdesc;
    myPara.classList.add("newsdisc");
    newsdiv.appendChild(myPara);

    myA = document.createElement('a');
    myA.classList.add("newsmore");
    myA.textContent = "More Info";
    myA.setAttribute('data-index', i);
    newsdiv.appendChild(myA);
   
    myrow.appendChild(newsdiv);
  }
  addEventsToMore();
}

function addEventsToMore(){
  var btns = document.querySelectorAll('.newsmore');
  btns.forEach(function(elem) {
    elem.addEventListener("click", function() {
        modalcont.innerHTML = '';
        var ind = elem.getAttribute('data-index');

        myspan = document.createElement('span');
        myspan.innerHTML = "&times;";
        myspan.classList.add("close1");
        myspan.addEventListener("click", function(){
          modal.style.display = "none";
        })
        modalcont.appendChild(myspan);

        myH1 = document.createElement('h1');
        myH1.textContent = newsdata.data[ind].title;
        myH1.classList.add("newshead");
        modalcont.appendChild(myH1);
        
        myImg = document.createElement('img');
        myImg.src = 'img/'+newsdata.data[ind].image;
        myImg.classList.add("newsimg");
        modalcont.appendChild(myImg);

        myPara = document.createElement('p');
        myPara.textContent = newsdata.data[ind].fulldesc;
        myPara.classList.add("newsdisc");
        modalcont.appendChild(myPara);

        modal.style.display = "block";
      });
  });
}

function SetActiveLink(element){
  Array.from(document.querySelectorAll('.pagination a.page-link')).forEach((el) => el.classList.remove('active'));
  element.classList.add('active');
}

function addEventsToPag(){
  var p = document.getElementById('pagination');
  var pbuttons = p.querySelectorAll('.page-link');
  pbuttons.forEach(function(elem) {
    elem.addEventListener("click", function() {
        currentpage = elem.innerHTML;
        SetActiveLink(elem);
        populateNews(currentpage);
      });
  });
  pbuttons = p.querySelectorAll('a');
  pbuttons[pbuttons.length-1].addEventListener("click", function(){
    currentpage = Number(currentpage)+1;
    if(currentpage>6){
      currentpage=6;
    }
    SetActiveLink(pbuttons[Number(currentpage)]);
    populateNews(currentpage);
  });
  pbuttons[0].addEventListener("click", function(){
    currentpage = Number(currentpage)-1;
    if(currentpage<1){
      currentpage=1;
    }
    SetActiveLink(pbuttons[Number(currentpage)]);
    populateNews(currentpage);
  });
}

searchbutton.addEventListener("click", function(){
  var myinput = document.getElementById("filterby");
  var result = newsdatadump.data.filter(x => x.shortdesc.toLowerCase().includes(myinput.value.toLowerCase()))
  newsdata.data = result;
  currentpage = 1;
  SetActiveLink(document.querySelectorAll('.page-link')[Number(currentpage-1)]);
  populateNews(currentpage);
});
    