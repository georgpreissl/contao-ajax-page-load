<?php

// namespace Contao;
namespace GeorgPreissl\ContaoAjaxPageLoad;

use Contao\StringUtil;
use Contao\Controller;
/**
 * Class ModuleCdList
 *
 * Front end module "cd list".
 */
class ModuleAjaxLoader extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_ajax-page-load';
	// protected $strTemplate = 'mod_test';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['cd_list'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
// dump($this->pages);


// $this->x = Controller::getFrontendModule(8,'main');


$this->pages = StringUtil::deserialize($this->pages, true);


		$objPages = \Contao\PageModel::findPublishedRegularWithoutGuestsByIds($this->pages, array('includeRoot'=>true));
		$arrPages = [];
		while ($objPages->next())
		{


			$objPage = $objPages->current();


			$href = $objPage->getFrontendUrl();
			$arrPages[] = $href;
			// dump($href);
		}

		// dump($arrPages);

		foreach ($this->pages as $objPage)
		{
			// dump($objPage);
		}
// dump(StringUtil::generateAlias("hello you äääh"));
		$this->Template->arrPages = $arrPages;



	}
}