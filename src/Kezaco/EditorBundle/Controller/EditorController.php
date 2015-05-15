<?php

namespace Kezaco\EditorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class EditorController extends Controller
{
    /**
     * @Route("/editor/{filename}", requirements={"filename": ".*"})
     */
    public function indexAction($filename)
    {
        $appRootDir = $this->container->getParameter('kernel.root_dir');
        $appBuilderBaseDir = $appRootDir.'/../vendor/snap-project/app-builder';
        $overwriteBaseDir = $appRootDir.'/../web/bundles/kezacoeditor/editor';

        if(empty($filename)) {
            $filename = 'index.html';
        }

        $filePath = $overwriteBaseDir.'/'.$filename;

        // Overwrite editor files with locals if they exists
        if (file_exists($filePath)) {
            return $this->sendFile($filePath);
        }

        $filePath = $appBuilderBaseDir.'/'.$filename;

        if (file_exists($filePath)) {
            return $this->sendFile($filePath);
        }

        throw $this->createNotFoundException();
    }

    protected function sendFile($filePath) {
        $filename = basename($filePath);
        $response = new BinaryFileResponse($filePath);
        $response->trustXSendfileTypeHeader();
        return $response;
    }

}
