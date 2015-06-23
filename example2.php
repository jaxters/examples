<?php

  public function setVariable($name,$value){
        
        $stmt = $this->conn->prepare('
        INSERT INTO variables (name, value)
        VALUES(?,?)
        on duplicate key
        update value=?');
        $stmt->bind_param("sss", $name, $value, $value);
        $stmt->execute();
        $num_affected_rows = $stmt->affected_rows;
        $stmt->close();
        return $num_affected_rows > 0;
    }
	
	public function getVariablesByName($name) {
    $stmt = $this->conn->prepare("SELECT value FROM variables WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
	
    if ($stmt->execute()) {
		$stmt -> bind_result($result);
		$stmt -> fetch();
		$value = $result;

		$stmt->close();
		return $value;
    } else {
		$stmt->close();
		return NULL;
    }
    }