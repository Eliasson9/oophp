<?php

class CBlog extends CBase {

	public $slug;
	public $html;

	public function __construct($dbconfig) {
		
		if(isset($_GET['slug'])) {
			$this->slug = $_GET['slug'];
		}
		$slugSql = $this->slug ? 'slug = ?' : '1';
		$sqlString = " SELECT * FROM Content
			WHERE  TYPE = 'post' AND $slugSql AND published <= NOW()
			ORDER BY updated DESC;";
		parent::__construct($dbconfig, $sqlString);
	}

	public function getContentAndBuildHtml() {
		$this->html = "";
		$res = $this->db->ExecuteSelectQueryAndFetchAll($this->sql, array($this->slug));
		if(isset($res[0])) {
  			foreach($res as $c) {
    			$title  = htmlentities($c->title, null, 'UTF-8');
    			$data   = $this->filter->doFilter(htmlentities($c->DATA, null, 'UTF-8'), $c->FILTER);
 
    			$this->html .= <<<EOD
	<section>
	  	<article>
		  	<header>
			<h1><a href='blog.php?slug={$c->slug}'>{$title}</a></h1>
			</header>
					 
			{$data}
					 
			<footer>
			</footer
		</article>
	</section>
EOD;
		  	}
		}
		else if($this->slug) {
		  $this->html = "Det fanns inte en sådan bloggpost.";
		}
		else {
		  $this->html = "Det fanns inga bloggposter.";
		}
	}
}