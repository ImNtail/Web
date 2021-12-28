mynames = [];
mynamesdump = [];
mylist = document.getElementById("mylist");
myloadbutton = document.getElementById("loadmore");
searchnickbtn = document.getElementById("getnick");
currentcount = 0;

window.addEventListener("load", function(){
    LoadNamesFromJson();
  });

function LoadNamesFromJson(){
    let requestURL = 'jsons/nicknames.json';
    let request = new XMLHttpRequest();
    request.open('GET', requestURL);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
      mynames = request.response;
      mynamesdump = request.response;     
      populateNames(currentcount);   
    }
}

function populateNames(count){
    listdata = "";
    for(let i =count; i<Math.min(mynames.data.length, count+10);i++){
        listdata+="<li>" + mynames.data[i] +"</li>"
    }
    mylist.innerHTML += listdata;
    currentcount+=10;
    if(currentcount>=mynames.data.length){
        RemoveLoadMore();
        return;
    }
    if(!document.getElementById("loadmore")){
        AddLoadMore();
    }
}
function AddLoadMore(){
    mya = document.createElement('a');
    mya.id = "loadmore";
    mya.textContent = "loadmore";
    mya.classList.add("addmorelink");
    mya.addEventListener("click", function(){
        populateNames(currentcount);
    });
    document.getElementById("ajaxser").appendChild(mya);
}

function RemoveLoadMore(){
    document.getElementById("ajaxser").removeChild(document.getElementById("loadmore"));   
}

searchnickbtn.addEventListener("click", function(){
    var myinput = document.getElementById("findnick");
    var result = mynamesdump.data.filter(x => x.toLowerCase().includes(myinput.value.toLowerCase()))
    mynames.data = result;
    currentcount = 0;
    mylist.innerHTML = '';
    populateNames(currentcount);
  });