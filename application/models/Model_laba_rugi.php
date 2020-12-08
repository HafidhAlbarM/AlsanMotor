<?php
 /**
 * 
 */
 class model_laba_rugi extends CI_Model
 {
    public function __construct()
    {
        parent::__construct();
    }
    function get_data_beban($FromDate,$ToDate){
        $sql="SELECT IFNULL(SUM(total),0) as data_beban FROM 
        (
            SELECT total FROM beban_h aa
            where aa.bulan BETWEEN '".$FromDate."' AND '".$ToDate."'
        )a"
        ;

        $hasil=$this->db->query($sql);
       
        return $hasil->row();
    }

    function get_data_beban_detail($FromDate,$ToDate){
        $sql="SELECT a.kode_beban, b.nama_beban, SUM(biaya) as biaya
        FROM
        (
           SELECT kode_beban, biaya FROM beban_d a
            INNER JOIN beban_h b on b.kode_transaksi_beban=a.kode_transaksi_beban
            WHERE b.bulan BETWEEN '".$FromDate."' AND '".$ToDate."'
        )a
        INNER JOIN beban b on a.kode_beban=b.kode_beban
        GROUP by kode_beban"
        ;
        $hasil=$this->db->query($sql);


        $sql2="
                SELECT 'B001' AS kode_beban,
                'Electricity' AS nama_beban,
                0 AS biaya
        UNION ALL
        SELECT 'B002' AS kode_beban,
                'Water' AS nama_beban,
                0 AS biaya
        UNION ALL      
        SELECT 'B003' AS kode_beban,
                'Employees Salary' AS nama_beban,
                0 AS biaya
        UNION ALL
        SELECT 'B004' AS kode_beban,
                'Service needs' AS nama_beban,
                0 AS biaya
        ";
        $hasil2=$this->db->query($sql2);

        if($hasil->num_rows!=0){
            return $hasil2->result();
        }else{
            return $hasil->result();
        }
        
        
    }

    function get_data_pembelian($FromDate,$ToDate){
        $sql="SELECT IFNULL(SUM(total),0) as data_pembelian FROM
        (
            SELECT*FROM pembelian_h
            WHERE tanggal_pembelian BETWEEN '".$FromDate."' AND '".$ToDate."'
        )a";

        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

    function get_data_penjualan($FromDate,$ToDate){
        $sql="SELECT IFNULL(SUM(total),0) as data_penjualan FROM 
        (
            SELECT*FROM penjualan_h
            WHERE tanggal_penjualan BETWEEN '".$FromDate."' AND '".$ToDate."'
        )a";

        $hasil=$this->db->query($sql);
        return $hasil->row();
    }

 }
 
?>