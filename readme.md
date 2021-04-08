# SVILUPPO DI SOFTWARE GESTIONALE PER AMBIENTI INVESTIGATIVI AD USO FORENSE

#### BACKEND: LARAVEL
#### DB:MYSQL
#### CRITTOGRAFIA ASIMMETRICA

## DESCRIZIONE DEL PROGETTO
Progettazione e sviluppo di un’applicazione di carattere gestionale per ambienti investigativi ad uso forense, che può essere utilizzata come piattaforma web di supporto 
per la creazione e il salvataggio protetto di immagini digitali.Il lavoro nasce dall’esigenza di avere uno strumento che permetta lo scambio di dati sensibili in maniera sicura tra le aziende che si occupano di consulenze forense ed i propri clienti, eliminando la “consegna a mano”.

Il progetto prevede un software di gestione, nel quale la messa in sicurezzadi immagini è l’obiettivo primario. Per il raggiungimento di tale obiettivo il sistema mette a disposizione le attività peculiari di registrazione dati utente, login, e soprattutto l’acquisizione e conservazione di immagini per mezzo di un canale sicuro che utilizzi protocolli di sicurezza, tali da preservare l’immagine originale; cosicché tale evidenza possa essere usata come prova scientifica ad uso forense. A tal fine bisogna introdurre il concetto di crittografia.

## CRITTOGRAFIA ASIMMETRICA
![image](https://user-images.githubusercontent.com/48923975/113997341-54ab7980-9858-11eb-8198-c8cfc588cb6e.png)

La crittografia è una scienza che attraverso l’uso di algoritmi permette a due utenti di mantenere riservate informazioni digitali a chi non dispone della 
relativa chiave di cifratura.
Tale processo consiste nel cifrare un messaggio o un documento digitale, inizialmente trasmesso in chiaro, con una chiave di cifratura univoca, 
cosicché solo il possessore della chiave è in grado di decifrare. Nella crittografia tradizionale detta simmetrica, possediamo un’unica 
chiave utilizzata sia per il processo di cifratura che di decifratura di un messaggio; mentre nella crittografia asimmetrica (figura1) ogni utentepossiede una coppia di chiavi inverse ma indipendenti tra loro, cioè Conoscendo una delle due chiavi non è possibile ricavare l’altra, esse sono:
* La chiave pubblica: è una sequenza di bit condivisa ed utilizzata per cifrare il messaggio, cosicché solo il possessore della chiave privata inversa potrà decifrare.
* La chiave privata: unica sequenza di bit in grado di decifrare i documenti cifrati per mezzo della chiave pubblica inversa.
La caratteristica fondamentale sta nel fatto che una volta codificato un documento con la chiave pubblica di un utente, si potrà decodificare solo ed esclusivamente con la chiave privata inversa alla chiave usata per codificare. 
La crittografia asimmetrica, oltre alla segretezza dei dati, garantisce autenticazione ed integrità attraverso l’uso di certificati e firma digitale.
![image](https://user-images.githubusercontent.com/48923975/113997781-c2f03c00-9858-11eb-83d4-a4d190bc9570.png)

Lo scopo fondamentale del progetto è quello di autenticare in maniera sicura l’utente che vuole accedere al sistema. Proprio per questo il software deve poter permettere di registrarsi al servizio e la verifica tramite login. Pertanto oltre all’uso della password, ci serviremo della crittografia asimmetrica. Completata la fase di registrazione dell’utente, verranno generate per ciascun utente le due chiavi e saranno conservate all’interno del database associato al software

## Three-tier
Una architettura three-tier è un modello di architettura software composta da tre livelli:
* Interfaccia utente
* Logica funzionale
* Livello di archiviazione dei dati
Questo modello architetturale viene impiegato nei sistemi client-server in cui sono presenti tre interfacce: livello utente, logica funzionale e il livello di 
archiviazione dei dati. La sua funzione principale è quella di separare le applicazioni utente e il database fisico, favorendo l’indipendenza dei dati del 
programma.
![image](https://user-images.githubusercontent.com/48923975/114002269-00ef5f00-985d-11eb-89f1-ae67660a14fe.png)
Grazie a questa caratteristica di rendere indipendenti i vari componenti è stato possibile scegliere le migliori tecnologie ed architetture dei singoli 
componenti, rispettando però i principi imposti per la comunicazione dei vari livelli di interfacce
![image](https://user-images.githubusercontent.com/48923975/114002419-254b3b80-985d-11eb-88af-1d2c2337f716.png)

## Attività di progettazione ed implementazione DB
Nella prima fase è necessario produrre un insieme di documenti: 
* Analisi dei requisiti: Dati generali 
* Schema concettuale, tramite modello E-R (strategia Top-Down) 
* Dizionario dei dati-Entità e Relazione 
* Lo schema ottenuto per ristrutturazione dalla prima fase della progettazione logica 
* Schema logico finale

Si vuole progettare un database per la gestione di casi in ambito forense. 

* L’utente che accede al sistema è identificato da codice univoco e da alcuni dati anagrafici, quali il nome, cognome l’indirizzo e altri dati 
quali email e password inseriti durante la registrazione al sistema, e da due chiavi (pubblica e privata). L’utente deve poter scegliere una tipologia di caso.
* La tipologia è specificata dall’utente che effettua la richiesta, ed è definita da un identificativo, dal nome, da uno script che sarà verificato grazie alle chiavi pubblica e privata dell’utente. Inoltre una tipologia deve avere il percorso della view, riferita alla tipologia scelta da caricare.
*Ogni caso deve avere un codice univoco, l’utente a cui fa riferimento il caso e la tipologia inerente.

## Schema concettuale Entità-relazione
Il modello entità-relazione (E-R) è un modello utilizzato per la riproduzione concettuale delle informazioni. L’importanza di utilizzare tale modello sta 
nel tradurre le informazioni estrapolate dall’analisi di un testo in uno schema concettuale, chiamato schema E-R (schema entità-relazione).
Inoltre è possibile utilizzare una strategia di progettazione molto utile, chiamata strategia Top-Down, nella quale la progettazione inizia con la dichiarazione delle parti più importanti(top), ovvero le entità, per poi suddividerle successivamente in parti più piccole(down), sotto forma di una piramide, in cui in cima vi sono posti le entità dello schema, mentre discendendo verso la base ritroviamo i dettagli che le compongono.
![image](https://user-images.githubusercontent.com/48923975/114003005-b28e9000-985d-11eb-84a6-00446017c518.png)

## MVC
Il Model-View-Controller (MVC) è un design pattern 8architetturale in grado di scomporre la logica di presentazione dalla logica di business che rende operativa un'applicazione
![image](https://user-images.githubusercontent.com/48923975/114003278-e79ae280-985d-11eb-845f-766e6939c79a.png)

## Protocollo per la codifica e decodifica dello script
La fase successiva alla generazione delle chiavi prevede la presenza all’interno del database di uno script per ogni tipologia di file selezionabile (immagine, audio e video) che verrà utilizzato nel momento in cui l’utente vuole memorizzare un file. Dopo l’autenticazione tramite login l’utente ha la 
possibilità di inserire i file da condividere. Per fare ciò utilizza le chiavi fornite dal server che permetteranno la decodifica dello script.
Vediamo in dettaglio il seguente protocollo per la codifica e decodifica:

1. Fase:Il server fornisce al controller, che gestisce la codifica e la decodifica, le due chiavi dell’utente corrispondente e lo script della tipologia selezionata.
2. Fase:Il controller, dopo aver ricercato dal database le chiavi dell’utente loggato e lo script, effettua la codifica dello script attraverso una funzione ideata in PHP che prende come parametri le chiavi e lo script:private function Encrypt($script, $public_key,$private_key). Questa funzione restituirà un oggetto JSON codificato e successivamente effettua le seguenti operazioni:
    * Otteniamo la lunghezza del vettore di inizializzazione della cifratura (iv) con openssl_cipher_iv_length()
    * Generiamo una stringa di byte pseudo-casuali, con il numero di byte determinato dalla lunghezza ottenuta nel passo precedente, passandolo come parametro nella funzione   openssl_random_pseudo_bytes($length)
    * Generiamo il salt, una sequenza casuale di bit openssl_random_pseudo_bytes(256)
    * Utilizziamo una funzione per ciascun chiave che generi una derivazione della chiave PBKDF2 di una password fornita:hash_pbkdf2('sha512', $public_key, $salt, $iterations, $length)
 hash_pbkdf2('sha512', $private_key, $salt, $iterations, $length)
    * ‘PBKDF2’ è un algoritmo di estensione della chiave ed esegue l'hash delle password in modo intensivo dal punto di vista computazionale, in modo che gli attacchi di dizionario e forza bruta siano meno efficaci.
    * ‘sha512’ algoritmo di hashing scelto
    * ‘key’ da utilizzare per la derivazione.
    * ‘salt’ da utilizzare per la derivazione. Un salt fornisce un ampio set di chiavi per ogni password, e un conteggio di iterazioni aumenta il costo di produzione delle chiavi da una password, aumentando così anche la difficoltà dell'attacco.
    * ‘iterations’ - Il numero di iterazioni interne da eseguire per la derivazione
    * ‘length’ - La lunghezza della stringa di output.
Infine utilizziamo la funzione che cripta i dati con il metodo e le chiave fornite, restituendo una stringa codificata raw:openssl_encrypt($script,"AES-256-CBC",hex2bin($hashKey_private), OPENSSL_RAW_DATA, $iv);
    * ‘Script’ ovvero i dati del messaggio in chiaro da crittografare
    * ‘AES-256-CBC’- Il metodo di cifratura.
    * ‘hex2bin’-Decodifica una stringa binaria codificata esadecimalmente.
    * ‘OPENSSL_RAW_DATA’ è una disgiunzione bit a bit 
    * ‘iv’- Un vettore di inizializzazione non NULL
    * Return dell’oggetto json_encode() con tutte le codifiche effettuate.
3. Fase:
Il controller carica la pagina web(view)dell’utente loggato passando l’oggetto ritornato dalla funzione di codifica. Per effettuare la decodifica all’utente 
verrà fornita la chiave pubblica, mentre la chiave privata verrà caricata attraverso un cookie9 che si autoeliminerà non appena verrà effettuato il logout.  

La decodifica è una funzione scritta in JavaScript:decrypt(script_criptato, public_key,private_key)
Questa funzione restituirà lo script decodificato se le chiavi corrispondono a quelle utilizzate per la codifica. Vediamo in dettaglio le operazioni svolte dalla funzione “decrypt” JSON.parse(CryptoJS.enc.Utf8.stringify(CryptoJS.enc.Base64.parse(script_criptato)));
    * JSON.parse()- converte i dati inviati dal server in un oggetto JavaScript
    * CryptoJS10.enc.Utf8.stringify() - Inverte l'array di parole in una stringa leggibile
    * CryptoJS.enc.Base64.parse - codifica lo script in base64.CryptoJS.enc.Hex.parse(json.salt)
    * codifica il salt presente nell’oggetto json in esadecimale.CryptoJS.enc.Hex.parse(json.iv)
    * codifica la lunghezza presente nell’oggetto json in esadecimale var encrypted = json.ciphertext
    * assegniamo alla variabile encrypted il testo che è stato crittografato. Hash_key_public=CryptoJS.PBKDF2(public_key,salt,{'hasher':CryptoJS.algo.SHA512, 'keySize': (encryptMethodL/8), 'iterations': iterations});
    * Creiamo una funzione hash per la chiave pubblica attraverso una funzione di derivazione della chiave pubblica.
    * CryptoJS.algo.SHA512 è un hashing progressivo con funzione Hash SHA512 che opera su parole a 64 bit.
    * Creiamo una funzione hash per la chiave privata attraverso una funzione di derivazione della chiave pubblica.Hash_key_private=CryptoJS.PBKDF2(privatec_key, salt{'hasher':CryptoJS.algo.SHA512, 'keySize': (encryptMethodL/8), 'iterations': iterations});”
    * Successivamente svolgiamo le due decodifiche: la prima basata su hash_key_public, e la seconda, quella finale, basata su hash_key_private passando come parametro il valore       ottenuto dalla prima decodifica:
    var public_decrypted_private_encrypted = CryptoJS.AES.decrypt(encrypted, public_hashKey, {'mode': CryptoJS.mode.CBC, 'iv': iv}).toString(CryptoJS.enc.Utf8);
    var final_decrypted = CryptoJS.AES.decrypt(public_decrypted_private_encrypted, private_hashKey, {'mode': CryptoJS.mode.CBC, 'iv': iv});52

Il valore ottenuto dalla decodifica “final_decrypted” sarà convertito in stringa per l’effettiva decodifca.final_decrypted.toString(CryptoJS.enc.Utf8)

## IMMAGINI DEL PROGETTO
![image](https://user-images.githubusercontent.com/48923975/114003547-1fa22580-985e-11eb-85dd-44d4a0594d16.png)
![image](https://user-images.githubusercontent.com/48923975/114003619-2e88d800-985e-11eb-92ca-d177057ca707.png)
![image](https://user-images.githubusercontent.com/48923975/114003671-3ba5c700-985e-11eb-814f-e62b82f01b7f.png)


