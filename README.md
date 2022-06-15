# Asterisk-Webfax

## Installation

1. add this context to your extensions_custom.conf and customize the line with FAXOPT(headerinfo) and FAXOPT(localstationid):

```
[webfax]
exten => s,1,Noop(Sending fax.....)
exten => s,n,Set(FAXOPT(ecm)=yes)
exten => s,n,Set(FAXOPT(maxrate)=14400)
exten => s,n,Set(FAXOPT(minrate)=2400)
exten => s,n,Set(FAXOPT(headerinfo)=Company-Name)
exten => s,n,Set(FAXOPT(localstationid)=+49 123-45678-99)
exten => s,n,SendFax(/var/www/html/webfax/sendfax.tiff)

exten => h,1,NoOp(Send Fax report)
exten => h,n,System(php -f /var/www/html/webfax/report.php "${FAXOPT(status)}" "${FAXOPT(statusstr)}" "${FAXOPT(error)}" "${FAXOPT(pages)}" "${FAXOPT(rate)}" "${FAXOPT(resolution)}" "${FAXOPT(remotestationid)}")
```

2. reload dialplan

```
asterisk -rx "dialplan reload"
```

3. copy index.php, report.php and style.css to /var/www/html/webfax

4. update to E-Mail in report.php

5. set permissions. for example:

```
chown -R asterisk:asterisk /var/www/html/webfax/
```


