<?php

namespace EchoSign\Info;

class FileInfos {

	protected $file_infos = array();

	function __construct(FileInfo $fileInfo = null) {
		if($fileInfo) {
			$this->file_infos[] = $fileInfo;
		}
	}

	function addFile(FileInfo $fileInfo) {
		$this->file_infos[] = $fileInfo;
	}

	function getFile() {
		return isset($this->file_infos[0]) ? $this->file_infos[0] : null;
	}

	function setFile(FileInfo $fileInfo) {
		$this->file_infos = array($fileInfo);
	}

	function asArray() {

		$fileInfos = array();
		foreach ($this->file_infos as $fileInfo) {
			$fileInfos[] = $fileInfo->asArray();
		}

		return $fileInfos;
	}

}
