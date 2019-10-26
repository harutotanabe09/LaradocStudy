(function() {
  
    var cmds = document.getElementsByClassName('del').length;
    var i;
    console.log(cmds);
  
    for (i = 0; i < cmds.length; i++) {
      cmds[i].addEventListener('click', function(e) {
        //イベント（Aタグに飛ぶ）
        e.preventDefault();
        if (confirm('are you sure?')) {
         console.log(this.dataset.id);
          document.getElementById('form_' + this.dataset.id).submit();
        }
      });
    }
  
})();