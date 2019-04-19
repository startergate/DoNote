/*jshint esversion: 9 */

class SID {
  constructor(clientname) {
    if (typeof jQuery == 'undefined') {
      throw new Error("SID.js for Client requires jQuery");
    }
    if (!window.localStorage) {
      throw new Error("SID.js for Client requires Local Storage support in browser");
    }
    if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.userAgent.indexOf('Trident') !== -1) { //Client Browser Detection
      throw new Error("SID.js for Client don't support IE");
    }
    this.clientname = clientname;
  }
  getProfile(clientid, sessid, callback) {
    $.ajax({
      url: 'http://sid.donote.co:3000/api/get/pfimg',
      type: 'POST',
      dataType: 'json',
      data: {
        'type': 'get',
        'data': 'pfimg',
        'clientid': clientid,
        'sessid': sessid
      },
      success: (data) => {
        callback(data.requested_data);
      }
    });
  }

  getClientID() {
    if (localStorage.sid_clientid) {
      return localStorage.sid_clientid;
    }
    return false;
  }

  getSessID() {
    if (localStorage.sid_sessid) {
      return localStorage.sid_sessid;
    }
    return false;
  }

  createClientID(devicedata) {
    $.ajax({
      url: 'http://sid.donote.co:3000/api/create/clientid',
      type: 'POST',
      dataType: 'json',
      data: {
        'type': 'create',
        'data': 'clientid',
        'devicedata': devicedata
      },
      success: (data) => {
        localStorage.sid_clientid = data.response_data;
      }
    });
  }
}