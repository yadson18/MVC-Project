<?php 
	class Delete extends Query{
		public function getResult(PDO $Connection){
			if(!empty($Connection)){
				try{
					$query = $Connection->prepare(
						"DELETE FROM {$this->getTable()}{$this->getCondition()}"
					);

					if(!empty($this->getConditionValues())){
						foreach($this->getConditionValues() as $column => $value){
							$query->bindValue(++$column, $value);
						}
					}

					$query->execute();
					return $query->rowCount();
				}
				catch(Exception $Exception){
					echo "Fail";
					exit();
				}
			}
			echo "Fail";
			exit();
		}
	}