// Notification count manipulation
var notificationsCount = document.getElementById('notifcount');
var markAsRead = document.getElementById('markAsRead');

markAsRead.addEventListener('click', runEvent);

var loggedadmintype = document.getElementById('loggedadmintype').value;
var loggeduserid = document.getElementById('loggeduserid').value;

// alert(loggedadmintype);
if (loggedadmintype.trim()=='Y'){
  // Pusher Notification
  var newticketpusher = new Pusher('b93fdf6c7660d0cef373', {
    cluster: 'ap1',
    encrypted: false
  });

  // Subscribe to the channel we specified in our Laravel Event
  var newticketchannel = newticketpusher.subscribe('ticket-created');
  // Bind a function to an Event (the full Laravel class)
  newticketchannel.bind('App\\Events\\ticketcreatedevent', function(data) {
    var notifcountelem = document.getElementById('notifcount');
    if (notifcountelem != null){
      var notifcounter = parseInt(document.getElementById('notifcount').innerHTML) + 1;
      document.getElementById('notifcount').innerHTML = notifcounter;
    } else {
      var newnotifcounter = document.createElement('span');
      var notificon = document.getElementById('notificon')
      newnotifcounter.setAttribute('class','notification');
      newnotifcounter.setAttribute('id','notifcount');
      notificon.appendChild(newnotifcounter);
      document.getElementById('notifcount').innerHTML = 1;
    }
      // document.getElementById('notifheadtitle').innerHTML = 'You have (' + notifcounter + ') new notification(s)';

      //get the parent ul
      var ul = document.getElementById('notif_ul');
      // create a new li element
      var newLi = document.createElement('li');
      // create a new link
      var a = document.createElement("a");

      var newdiv = document.createElement('div');
      newdiv.setAttribute('class','pull-left')
      var newimg = document.createElement('img');
      newimg.setAttribute('src', '/sjdbranchworks/public/uploads/avatars/' + data.userpix + '.png');
      newimg.setAttribute('class', 'img-circle');
      var newh4 = document.createElement('h7');
      var newp1 = document.createElement('p');
      var newp2 = document.createElement('p');
      newp1.className = "notifitem";
      var newSmall = document.createElement('small');

      // set the link's attributes
      newh4.textContent = data.message;
      newp1.textContent = data.issue + ' - ' + data.priority + ' priority';
      var alink = "/sjdbranchworks/public/ticket-management/"+ data.eventticketid + "/edit";
      a.setAttribute('href',alink);
      // add new the link to the new li element
      newLi.appendChild(a);

      a.appendChild(newdiv);
      newdiv.appendChild(newimg);
      a.appendChild(newh4);
      a.appendChild(newp1);
      a.appendChild(newp2);
      newp2.appendChild(newSmall);
      // now add the li element with the new link to the parent ul
      ul.appendChild(newLi)
      // now insert new created elements to the DOM
      ul.insertBefore(newLi, ul.childNodes[0]);

      //prevent the ticket maker getting notified with his/her own activity
      if (loggeduserid!=data.userid){
        Push.create(data.message, {
          body: "New created ticket",
          icon: "/sjdbranchworks/public/uploads/avatars/" + data.userpix + ".png",
          timeout: 8000,
          onClick: function () {
              window.focus();
              this.close();
          }
        });
      }
  });
}

// User is not an admin, make notifications for assigned tickets

  // Pusher Notification
  var newassignpusher = new Pusher('b93fdf6c7660d0cef373', {
    cluster: 'ap1',
    encrypted: false
  });

  // Subscribe to the channel we specified in our Laravel Event
  var newassignchannel = newassignpusher.subscribe('ticket-assigned');

  newassignchannel.bind('App\\Events\\ticketassignedevent', function(data) {
    if (loggeduserid.trim()==data.userid){
      var notifcountelem = document.getElementById('notifcount');
      if (notifcountelem != null){
        var notifcounter = parseInt(document.getElementById('notifcount').innerHTML) + 1;
        document.getElementById('notifcount').innerHTML = notifcounter;
      } else {
        var newnotifcounter = document.createElement('span');
        var notificon = document.getElementById('notificon')
        newnotifcounter.setAttribute('class','notification');
        newnotifcounter.setAttribute('id','notifcount');
        notificon.appendChild(newnotifcounter);
        document.getElementById('notifcount').innerHTML = 1;
      }
      // document.getElementById('notifheadtitle').innerHTML = 'You have (' + notifcounter + ') new notification(s)';

      //get the parent ul
      var ul = document.getElementById('notif_ul');
      // create a new li element
      var newLi = document.createElement('li');
      // create a new link
      var a = document.createElement("a");

      var newdiv = document.createElement('div');
      newdiv.setAttribute('class','pull-left')
      var newimg = document.createElement('img');
      newimg.setAttribute('src', '/sjdbranchworks/public/uploads/avatars/' + data.userpix + '.png');
      newimg.setAttribute('class', 'img-circle');
      var newh4 = document.createElement('h7');
      var newp1 = document.createElement('p');
      newp1.className = "notifitem";
      var newp2 = document.createElement('p');
      var newSmall = document.createElement('small');

      // set the link's attributes
      newh4.textContent = data.message;
      newp1.textContent = data.issue + ' - ' + data.priority + ' priority';
      var alink = "/sjdbranchworks/public/ticket-management/"+ data.eventticketid + "/edit";
      a.setAttribute('href',alink);
      // add new the link to the new li element
      newLi.appendChild(a);

      a.appendChild(newdiv);
      newdiv.appendChild(newimg);
      a.appendChild(newh4);
      a.appendChild(newp1);
      a.appendChild(newp2);
      newp2.appendChild(newSmall);
      // now add the li element with the new link to the parent ul
      ul.appendChild(newLi)
      // now insert new created elements to the DOM
      ul.insertBefore(newLi, ul.childNodes[0]);

      Push.create(data.message, {
        body: "New assigned ticket",
        icon: "/sjdbranchworks/public/uploads/avatars/" + data.userpix + ".png",
        timeout: 8000,
        onClick: function () {
            window.focus();
            this.close();
            }
          });

      }

    });


// User is not an admin, make notifications for closed tickets

  // Pusher Notification
  var newclosedpusher = new Pusher('b93fdf6c7660d0cef373', {
    cluster: 'ap1',
    encrypted: false
  });

  // Subscribe to the channel we specified in our Laravel Event
  var newclosedchannel = newclosedpusher.subscribe('ticket-closed');

  newclosedchannel.bind('App\\Events\\ticketclosedevent', function(data) {
    if (loggeduserid.trim()==data.userid){
      console.log(data.userid);
      var notifcountelem = document.getElementById('notifcount');
      if (notifcountelem != null){
        var notifcounter = parseInt(document.getElementById('notifcount').innerHTML) + 1;
        document.getElementById('notifcount').innerHTML = notifcounter;
      } else {
        var newnotifcounter = document.createElement('span');
        var notificon = document.getElementById('notificon')
        newnotifcounter.setAttribute('class','notification');
        newnotifcounter.setAttribute('id','notifcount');
        notificon.appendChild(newnotifcounter);
        document.getElementById('notifcount').innerHTML = 1;
      }
      // document.getElementById('notifheadtitle').innerHTML = 'You have (' + notifcounter + ') new notification(s)';

      //get the parent ul
      var ul = document.getElementById('notif_ul');
      // create a new li element
      var newLi = document.createElement('li');
      // create a new link
      var a = document.createElement("a");

      var newdiv = document.createElement('div');
      newdiv.setAttribute('class','pull-left')
      var newimg = document.createElement('img');
      newimg.setAttribute('src', '/sjdbranchworks/public/uploads/avatars/' + data.userpix + '.png');
      newimg.setAttribute('class', 'img-circle');
      var newh4 = document.createElement('h7');
      var newp1 = document.createElement('p');
      newp1.className = "notifitem";
      var newp2 = document.createElement('p');
      var newSmall = document.createElement('small');

      // set the link's attributes
      newh4.textContent = data.message;
      newp1.textContent = 'is closed by ' + data.username;
      var alink = "/sjdbranchworks/public/ticket-management/"+ data.eventticketid + "/show";
      a.setAttribute('href',alink);
      // add new the link to the new li element
      newLi.appendChild(a);

      a.appendChild(newdiv);
      newdiv.appendChild(newimg);
      a.appendChild(newh4);
      a.appendChild(newp1);
      newp1.appendChild(newSmall);
      a.appendChild(newp2);
      newp2.appendChild(newSmall);
      // now add the li element with the new link to the parent ul
      ul.appendChild(newLi)
      // now insert new created elements to the DOM
      ul.insertBefore(newLi, ul.childNodes[0]);

      Push.create(data.message, {
        body: "Your ticket have been closed",
        icon: "/sjdbranchworks/public/uploads/avatars/" + data.userpix + ".png",
        timeout: 8000,
        onClick: function () {
            window.focus();
            this.close();
        }
      });
    }
  });


// functions
function runEvent(e){
  // e.preventDefault();

  // Update notifications as read
  $.get('markAsRead');
  // set notification count to zero, notification has been read
  var notifcountelem = document.getElementById('notifcount');
  if (notifcountelem != null){
    document.getElementById('notifcount').innerHTML = 0;
  }
}
