<?php

/**
 * Exports newsletter subscribers in an CSV file.
 *
 * @author Jonathan Ströbele (planungbuero.de)
 */

class pbi_mailexport extends oxAdminView {

    /**
     * Current class template name.
     *
     * @var string
     */
    protected $_sThisTemplate = "pbi_mailexport.tpl";


    /**
     * Delimiter between CSV values.
     *
     * @var string
     */
    protected $_sDelimiter = ";";

    /**
     * Default varibale
     *
     * @var string
     */
    protected $_sDefaultFilename = "mailexport.csv";

    /**
     * The render function is invoked before the smarty
     * template is evaluated.
     *
     * @return string The template to be shown.
     */
    public function render() {

		// current optinid
		$optinid = (oxConfig::getParameter( "pbi_exportform_stateid" )) ? oxConfig::getParameter( "pbi_exportform_stateid" ) : 0;

		// counter
		$optinid_counter = 0;


		$sSql = 'SELECT oxid FROM oxnewssubscribed AS s WHERE oxdboptin =  ' . (int) $optinid;
		$rs = oxDb::getDb(true)->Execute( $sSql);

        // Providing variables to the view.
        $this->_aViewData['optinid_counter'] = $rs->_numOfRows;
		$this->_aViewData['optinid'] = $optinid;
		$this->_aViewData['aOptinIds'] = $aOptinIds;

        return parent::render();
    }

    /**
     * Filters the subscriber records and provides an CSV for download.
     *
	 * @todo Calls exit() -> bad!
	 *
     * @return void
     */
	public function export() {
		$subscriberListCSV = array();
		$optinid = (oxConfig::getParameter( "pbi_exportform_stateid" )) ? oxConfig::getParameter( "pbi_exportform_stateid" ) : 0;

		$sSql = 'SELECT oxid FROM oxnewssubscribed AS s WHERE oxdboptin =  ' . (int) $optinid;
		$rs = oxDb::getDb(true)->Execute( $sSql);

		while (!$rs->EOF) {
			$new = oxNew("oxnewssubscribed");
			$new->load($rs->fields[0]);
			$subscriberListCSV[] = $new;
			$rs->MoveNext();
		}

		$this->downloadHeadersCSV();
		echo $this->buildCSV($subscriberListCSV);

		exit();

		// Providing variables to the view.
        //$this->_aViewData['subscriberList'] = $subscriberListCSV;
	}

    /**
     * Adds HTTP headers for  CSV Download.
     *
	 * @param string $filename If not specified, default is "mailexport.csv"
     * @return void
     */
	private function downloadHeadersCSV($filename = null) {

		if (is_null($filename)) {
			$filename = $this->_sDefaultFilename;
		}

		header('Content-Description: File Transfer');
		header("Content-Type: application/csv") ;
		header("Content-Disposition: attachment; filename=" . $filename);
		header("Expires: 0");
	}

    /**
     * Generates the CSV text.
	 *
	 * @todo should be in a view template?!
     *
	 * @param
     * @return string The CSV text
     */
	private function buildCSV($data) {

		$csv = 'oxid;oxuserid;oxsal;oxfname;oflname;oxemail;oxdboptin;oxemailfailed;oxsubscribed;oxunsubscribed;oxtimestamp' . "\n";

        foreach($data as $row) {
            $csvRow = array(
				$row->oxnewssubscribed__oxid->value,
				$row->oxnewssubscribed__oxuserid->rawValue,
				$row->oxnewssubscribed__oxsal->rawValue,
				$row->oxnewssubscribed__oxfname->rawValue,
				$row->oxnewssubscribed__oxlname->rawValue,
				$row->oxnewssubscribed__oxemail->rawValue,
				$row->oxnewssubscribed__oxdboptin->rawValue,
				$row->oxnewssubscribed__oxemailfailed->rawValue,
				$row->oxnewssubscribed__oxsubscribed->rawValue,
				$row->oxnewssubscribed__oxunsubscribed->rawValue,
				$row->oxnewssubscribed__oxtimestamp->rawValue,
			);
			$csv .= implode($this->_sDelimiter, $csvRow) . "\n";
		}

		return $csv;
	}
}

?>
