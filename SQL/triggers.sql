-- INSERT NEW INVENTORY RECORD ON NEW MENU ITEM INSERT
CREATE TRIGGER `ins_NewInv` AFTER INSERT ON `menu_MenuItem`
  FOR EACH ROW BEGIN
  INSERT INTO `menu_Inventory` (`menu_Inventory`.`id_MenuItem`, `menu_Inventory`.`Inventory`)
  VALUES (NEW.`id_MenuItem`, 0);
END