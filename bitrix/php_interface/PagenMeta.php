<?php
namespace SolverWeb\Seo;
use Bitrix\Main\EventManager;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Ingate\Seo\PageTable;

class PagenMeta {
    private $APPLICATION;
    private $request;
    private $protocol;
    private $domain;
    private $requestUri;
    private static $instance;
    private $setPagenCanonical;
    private $title_str;
    private $descr_str;
    private $seoMetaOpt;
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function init()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->addEventHandler("main", 'OnEndBufferContent', [$this, 'h1']);
        $eventManager->addEventHandler("main", 'OnEpilog', [$this, 'metaTags']);
        $eventManager->addEventHandler("main", 'OnEpilog', [$this, 'setPagenCanonical']);
    }
    public function __construct()
    {
        $this->APPLICATION = $GLOBALS["APPLICATION"];
        $instanceHTTP = HttpApplication::getInstance();
        $this->request = $instanceHTTP->getContext()->getRequest();
        $this->protocol = (\CMain::IsHTTPS()) ? "https://" : "http://";
        $this->domain = $instanceHTTP->getContext()->getServer()->getServerName();
        $this->requestUri = explode('?', $this->request->getRequestUri())[0];
        if ($GLOBALS["SSM_OPT"]["setPagenCanonical"]) {
            $this->setPagenCanonical = $GLOBALS["SSM_OPT"]["setPagenCanonical"];
        }
        if ($GLOBALS["SSM_OPT"]["title_str"]) {
            $this->title_str = $GLOBALS["SSM_OPT"]["title_str"];
        }
        if ($GLOBALS["SSM_OPT"]["descr_str"]) {
            $this->descr_str = $GLOBALS["SSM_OPT"]["descr_str"];
        }
        if (Loader::includeModule('ingate.seo')) {
            $this->seoMetaOpt = PageTable::getList([
                'filter' => [
                    'URL' => '%' . $this->domain . $this->requestUri,
                    'ACTIVE' => 'Y'
                ],
            ])->fetch();
        }
    }
    public function metaTags()
    {
        $instance = self::getInstance();
        if ($instance->APPLICATION->GetPageProperty('PAGEN_PAGE') < 2) {
            return;
        }
        $title = $instance->seoMetaOpt["TITLE"] ?: ($instance->APPLICATION->GetPageProperty('title') ?: $instance->APPLICATION->GetTitle());
        $desc = $instance->seoMetaOpt["DESCRIPTION"] ?: ($instance->APPLICATION->GetPageProperty('description') ?: $instance->APPLICATION->GetDirProperty('description'));
        if ($title) $instance->APPLICATION->SetPageProperty('title', trim($title,'.,|') . $instance->title_str . $instance->APPLICATION->GetPageProperty('PAGEN_PAGE'));
        if ($desc) $instance->APPLICATION->SetPageProperty('description', rtrim($desc,'.,|'). $instance->descr_str . $instance->APPLICATION->GetPageProperty('PAGEN_PAGE').'.');
    }
    public function h1(&$content)
    {
        $instance = self::getInstance();
        if ($instance->APPLICATION->GetPageProperty('PAGEN_PAGE') < 2) {
            return;
        }
        $h1 = $instance->seoMetaOpt["H1"] ?: $instance->APPLICATION->GetTitle();
        if ($h1) $content = preg_replace('/<h1([^>]*)>(.*?)<\/h1>/', '<h1 $1>'.$h1.'</h1>', $content);
    }
    private function getPagen() {
        $instance = self::getInstance();
        if ($instance->APPLICATION->GetPageProperty('PAGEN_PAGE') < 2) {
            return;
        }
        return $instance->APPLICATION->GetPageProperty('PAGEN_ID') . "=" . $instance->APPLICATION->GetPageProperty('PAGEN_PAGE');
    }
    public function setPagenCanonical()
    {
        $instance = self::getInstance();
        if ($instance->APPLICATION->GetPageProperty('PAGEN_PAGE') < 2) {
            return;
        }
        if ($instance->setPagenCanonical == "Y") {
            $href = $instance->protocol.$instance->domain.$instance->requestUri. "?" . $instance->getPagen();
            $instance->APPLICATION->SetPageProperty('canonical', $href);
        }
    }
}