var ajax = {
  init: function() {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');
    } catch(e) {
      try {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
      } catch(e) {
        xhr = false;
      }
    }
    if(!xhr && typeof XMLHttpRequest!='undefined') {
      xhr = new XMLHttpRequest();
    }
    return xhr;  
  },
  request: function(param) {
    var r = ajax.init(), method = param.method || 'POST';
    r.open(method, param.url, true);
    r.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    r.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    r.send(param.data);
    if(param.showProgress) {
      param.showProgress();
    }
    r.onreadystatechange = function() {
      if(r.readyState == 4) {
        if(r.status >= 200 && r.status < 300) {
          var response = parseJSON(r.responseText);
          if(response.js) {
            ajax.pasteJs(response.js);
          }
          if(param.success) {
            param.success(response);
          }
        }      
        if(param.hideProgress) {
          param.hideProgress();
        }
      }
    };  
    return r;
  },
  post: function(param) {
    return ajax.request({
      url: param.url,
      data: param.data,
      method: 'POST',
      showProgress: param.showProgress,
      hideProgress: param.hideProgress,
      success: param.success,
      error: param.error,
    });
  },
  get: function(param) {
    return ajax.request({
      url: param.url,
      method: 'GET',
      showProgress: param.showProgress,
      hideProgress: param.hideProgress,
      success: param.success,
      error: param.error,
    });
  },
  pasteJs: function(js) {
    if(!js) return false;
    var code = document.createElement('script');
    code.type = 'text/javascript';
    code.innerHTML = js;
    document.head.appendChild(code);
  }
}


function parseJSON(obj){
  if(window.JSON && JSON.parse) {
    return JSON.parse(obj);
  }
  return eval('('+obj+')');
}
function topMenuSearch(value) {
  if(value.length < 1) { 
    return false;
  }
  var html='';  
  html += '<a href="/search2.php?q='+document.getElementById('dffg').value+'" target="_blank"><div class="okantovka" style="background-color:#FBFBFB">Показать все результаты</div></a>';
  ajax.get({
    url: '/search.php?q='+value,
    data: '',
    success: function(data) {
      for(var i in data) {
        html += '<a href="/food.php?food_id='+data[i].id+'" target="_blank"><div class="okantovka">'+data[i].title+'</div></a>';
      }
      document.getElementById('lol').innerHTML=html;
    }
  });
}


var Head = {
  show: function() {
    $('#sidebar').css({'margin-left':'0px'});
    $('#sidebar-global__layer').show();
  },
  hide: function() {
    $('#sidebar').css({'margin-left':'-250px'});
    $('#sidebar-global__layer').hide();
  }
}
