<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'target' => '081578714012',
        'message' => 'Hai Kanti, 
sebelumnya ini nomor wa ku satunya yang baru
aku ga pakai nomerku yang utama karena takut ke block
soalnya ini pakai third party service

Aku nulis ini bukan untuk bikin kamu nggak nyaman, tapi karena aku ngerasa perlu ngungkapin semuanya sebelum bener-bener, ngelepas? Mungkin ini bakal jadi pesan dari aku yang isinya campur aduk, tapi semoga kamu bisa baca sampai akhir.

Kamu itu… beda.
Di mataku, kamu cantik… cantiknya beda. Cantik yang nggak ngebosenin. Matamu (bagus banget), senyummu, bahkan suaramu (suara km lucu tau) —semuanya punya tempat sendiri di ingatan aku. Muka kamu juga khas banget, susah dicari yang mirip. Setiap kali aku bilang kamu lucu, itu bukan basa-basi, itu benerann

Gausah diraguin kamu emang cantik
Tapi aku suka bukan cuma karena fisikmu. Kamu tipe cewek ceria yang tetap kalem di luar, tapi rame kalau udah nyaman. Kamu juga ramah, baik, pinter, sat-set kalo ngerjain tugas atau kerjaan, ga aneh, kerja tim kamu bagus, dan pinter masak pula. Nggak heran kalau orang-orang di sekitarmu suka dan nyaman sama kamu. Kamu tu kayak magnet—selalu bisa narik perhatian orang dengan cara km sendiri. liat aja, banyak yang tertarik, cowo? apalagi wkw

Kita pernah deket.
and that was my first experience bisa ngerasain nyaman sama seorang cewe yg jadi "temen". gabohong… the fact is you\'re my first love. btw dari povku antara tertarik, kagum, sama jatuh cinta itu beda yah. di awal tentu aku tertarik dulu pastinya, tapi makin lama sama kamu aku jatuh... beneran jatuh. Setelah beberapa lama, respon kamu perlahan mulai berubah disaat aku udah ngerasa nyaman dan jatuh banget, dan aku sadar semuanya udah nggak sama lagi, parah sii :((

inget ga waktu aku closure km? waktu itu, aku lakuin karena memang aku ada dititik cape berjuang sendiri, sebenernya aku ga mau berhenti tapi feedback km udah kayak gitu :(( dan yahh, ternyata km juga ngelepas. tapi habis itu aku tetep masih lanjut ngechat. karna memang nyatanya aku gabisaaaa

aku bahkan ga ngerti kenapa air mataku juga pernah bisa jatuh gatau waktu & tempat. ini langka banget sebelumnya, bahkan gaperna terjadi. dulu aku mikir aku terlalu lebay, tp setelah aku pikir kamu memang segitu berartinya buat aku. kamu worth it buat dikejar. walaupun akhirnya tetep sakit.

Aku juga sempat bingung tiap kamu bikin instastory atau postingan yang sedih—aku jadi mikir, itu maksudnya apa ya? Tapi balik lagi, respon kamu ke aku tetap sama. inget banget waktu di couve seturan sebelum kamu balik ke bandung, km mulai nyuekin aku. disitu aku sadar banget kalo ini udah gabisa dilanjutin.

Tapi menjelang wisuda, kamu mulai welcome lagi. Dan jujur aja, aku berharap itu jadi tanda kamu masih mau buka hati, tapi kenyataannya mungkin km cuma pengen temenan biasa. tapi aku nganggepnya lebih. Aku sempat pengen confess lagi, tapi waktunya sempit. Kamu pulang, dan sekarang semuanya terasa makin jauh. dan sekarang ini aku mau serius lagi tp gimanapun dari kamu… kamu udah ga ngasih chance lagi. yg sebenernya udah jelas dari respon kamu, bahkan aku juga udah gabisa reply instastory  tapi aku masih tetep denial. sampai kemarin kamu sendiri yg bilang secara ga langsung kalau emang udah gaada chance lagi.

aku nggak bilang bakal nyerah kaya dulu lagi, tapi aku juga nggak mau kamu sampai ngerasa risih. Maaf ya, aku belum bisa move on. Teman level 4 ini masih terlalu susah buat aku lupain. tadinya webapps ini bukan mau kujadiin tulisan yg kayak gini, justru mau aku pake buat ngeyakinin kamu lagi

so, seriously, there\'s really no chance left for me?

see you kalau masih dipertemukan, hope the best for u and glad to know you

i loved you kanti
no, actually, i am still love you from afar


—Rosyihan',
    ),
    CURLOPT_HTTPHEADER => array(
        "Authorization: 3WBLxApLfht2y4tLHaVC" //change TOKEN to your actual token
    ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo json_encode(['status' => 'error', 'message' => $error_msg]);
} else {
    echo json_encode(['status' => 'success', 'response' => $response]);
}
curl_close($curl);
?>