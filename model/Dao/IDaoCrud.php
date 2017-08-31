<?php
/**
 * Interface que define os métodos dos DAO´s que farão CRUD
 * @author Ronily
 *
 */
interface IDaoCrud{
	
	public function inserir( $objeto );
	
	public function consultar( $nome = null );
	
	public function atualizar( $objeto );
	
	public function deletar( $pk );
	
}