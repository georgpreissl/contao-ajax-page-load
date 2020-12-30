<?php

namespace GeorgPreissl\ContaoAjaxPageLoad;

use Contao\StringUtil;
use Contao\Controller;
use Contao\PageModel;


class ModuleAjaxPageLoad extends \Module
{


	protected $strTemplate = 'mod_ajax-page-load';


	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['ajaxpageload'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}



	protected function compile()
	{


		$this->pages = StringUtil::deserialize($this->pages, true);

		$objPages = PageModel::findPublishedRegularWithoutGuestsByIds($this->pages, array('includeRoot'=>true));
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