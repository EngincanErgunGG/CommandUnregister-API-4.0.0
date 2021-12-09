# CommandUnregister API 4.0.0

MC:BE 1.18.0 API 4.0.0 ve Üstünde Çalışır.

Sunucunuzdaki istenmeyen komutları sunucudan siler.

### Nasıl Silinecek Komut Eklerim?

Sunucunuzun dosyalarından plugin_data klasörüne girin. Ardından CommandUnregsiter klasörüne basın. Karşınıza commands.yml çıkacaktır. O dosyanın içinden silinecek komutları ayarlayabilirsiniz.

### Düzenleme
```yaml
Commands:
 - "commandName"
```

### Başka Bir Eklentiden Nasıl Kullanabilirim?

Evet, yanlış görmedin. Bu eklentiyi başka bir eklentiden yönetebilirsin. Kullanım:

use;
```php
use KurSkyTR\UnregisterCommand;
```
Kullanım;

Listeye Komut Ekleme:
```php
UnregisterCommand::addUnregisterCommandList("commandName");
```
Listeden Komut Silme:
```php
UnregisterCommand::removeUnregisterCommandList("commandName");
```

Bu işlemler yapıldıktan sonra sunucuyu yeniden başlatmanız gerekmektedir.
