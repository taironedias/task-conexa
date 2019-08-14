select id from User 
	where username='adm' and password='123456';

select * from Post where idUser=2;

select * from Post order by dataPost desc limit 10;

select c.texto, u.username from Comentario c join User u on u.id=c.idUser where c.idPost=2;

select * from Comentario;
SELECT COUNT(*) FROM Comentario WHERE idPost = 3;