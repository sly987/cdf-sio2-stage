delimiter limite

create procedure fillMonth(anneeDebut bigint, anneeFin bigint)
Begin

set autocommit =0;
while anneeDebut<=anneeFin do
    set @i = 1;
    while @i <13 do
        insert into mois(mois_id, annee_id) values(@i, anneeDebut);
        set @i = @i+1;
    end while;
set anneeDebut =anneeDebut +1;
end while;
End; limite 





