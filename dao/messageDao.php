<?php
include_once('../model/message.php');

class messageDao {
	
    public function getMessageById($id){
        $messageSQL = self::$connexion->ExecuteSelectOne('SELECT * FROM message WHERE IDMESSAGE = ' . $id);
        $message = new message($messageSQL['IDMESSAGE'], $messageSQL['LBLMESSAGE'], $messageSQL['DATEMESSAGE'], $messageSQL['IDMESSAGE_REPONDRE'], $messageSQL['IDUSER'], $messageSQL['IDTRAIN']);
        return $message;
    }
    
    public function createMessage($label, $date, $idMessageParent, $idProprietaire, $idTrain){
        $tabData = array();
        $tabData['LBLMESSAGE'] = $label;
        $tabData['DATEMESSAGE'] = $date;
        $tabData['IDMESSAGE_REPONSE'] = $idMessageParent;
        $tabData['IDUSER'] = $idProprietaire;
        $tabData['IDTRAIN'] = $idTrain;
        self::$connexion->ExecuteInsert('INSERT INTO message(LBLMESSAGE, DATEMESSAGE, IDMESSAGE_REPONDRE, IDUSER, IDTRAIN) VALUES (:LBLMESSAGE, :DATEMESSAGE, :IDMESSAGE_REPONDRE, :IDUSER, :IDTRAIN)', $tabData);
        $tabMod = array();
        $tabMod['IDUSER'] = $idProprietaire;
        self::$connexion->ExecuteUpdate('UPDATE user SET NBMESSAGE = NBMESSAGE + 1 WHERE IDUSER = :IDUSER', $tabMod);
    }
}

?>
