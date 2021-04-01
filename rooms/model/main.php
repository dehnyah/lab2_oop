<?php
/**
 * User Controller
 *
 * @author Serhii Shkrabak
 * @global object $CORE->model
 * @package Model\Main
 */
namespace Model;
class Main
{
	use \Library\Shared;

	public function formsubmitAmbassador(array $data):?array {
		// Тут модель повинна бути допрацьована, щоб використовувати бази даних, тощо
		$key = '1740490177:AAEt0_x8VPnGOsIRkIBk1DGPanEdfoj55Qc'; // Ключ API телеграм
		$result = null;
		$chat =  489537422;
		$text = "Нова заявка в *MID_LANE*:\n" . $data['firstname'] . ' '. $data['secondname']. ', '. $data['position'] . "\n*Зв'язок*: " . $data['phone'] . "\n*E-mail*: " . $data['email'];
		$text = urlencode($text);
		$answer = file_get_contents("https://api.telegram.org/bot$key/sendMessage?parse_mode=markdown&chat_id=$chat&text=$text");
		$answer = json_decode($answer, true);
		$result = ['message' => $answer['result']];
		return $result;
	}

	public function __construct() {

	}
}