let sid = new SID();
if (!sid.getClientID()) {
  sid.createClientID(navigator.userAgent);
}