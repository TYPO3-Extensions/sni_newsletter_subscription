<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Georg Schönweger <georg.schoenweger@gmail.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Description of Newsletter
 *
 * @author snillo
 */
class Tx_SniNewsletterSubscription_Domain_Validator_NewsletterValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

    /**
    * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
    * @inject
    */
    protected $objectManager;
    
	public function isValid($value) {        
		$userRepository = $this->objectManager->get('Tx_SniNewsletterSubscription_Domain_Repository_UserRepository');
		$user = $userRepository->findByEmail((string)$value);
		if($user && $user->getEmail()) {
			if(count($user->getModuleSysDmailCategory()) > 0) {
				$this->addError('You are already registered for the newsletter',1308671052);
				return (FALSE);
			} 
		}
		$addressRepository = $this->objectManager->get('Tx_SniNewsletterSubscription_Domain_Repository_TtAddressRepository');
		$address = $addressRepository->findEmail((string)$value);
		if($address) {
			$this->addError('You are already registered for the newsletter',1308671052);
			return (FALSE);
		} 
		return (TRUE);
	}

}
?>
